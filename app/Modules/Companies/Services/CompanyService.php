<?php

namespace Modules\Companies\Services;

use App\Events\CompanyStatusUpdated;
use App\Models\Company;
use App\Models\CompanyHasImage;
use App\Models\FeaturedCategoriesHasProduct;
use App\Models\User;
use Modules\Categories\Contracts\CategoryRepository;
use Modules\Companies\Contracts\CompanyRepository;
use Modules\Companies\Contracts\CompanyService as CompanyServiceContract;

class CompanyService implements CompanyServiceContract
{

    protected $categoryRepository;
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository, CategoryRepository $categoryRepository)
    {
        $this->companyRepository = $companyRepository;

        $this->categoryRepository = $categoryRepository;
    }

    public function uploadImage($name, $file, $id = null)
    {
        $company = $id ? $this->findById($id) : auth()->user()->seller->company;
        $path = $file->store('public/companies');

        switch ($name) {
            case 'logo':
                $company->logo = $path;
                $company->save();
                (new \Modules\Utilities\ProcessImage(storage_app_path($path), Company::DEFAULT_LOGO_SIZE))->crop()->fit()->save();
                break;
            default:
                $modificationDetails['zoom'] = "0";
                $modificationDetails['position']['x'] = "0";
                $modificationDetails['position']['y'] = "0";
                $company->images()->whereId($name)->update(['image' => $path, 'position_x' => 0, 'position_y' => 0, 'modification_details' => json_encode($modificationDetails)]);
                (new \Modules\Utilities\NewCropImage(storage_app_path($path), CompanyHasImage::$size[request()->type]))->resize()->crop()->save();
                break;
        }
        return get_cropped_image_path($path);
    }

    public function findById($id)
    {
        return $this->companyRepository->findById($id);
    }

    public function updateLogoPhotos($data, $id = null)
    {
        $company = $id ? $this->findById($id) : auth()->user()->seller->company;

        return \DB::transaction(function () use ($company, $data) {
            $company->description = $data['description'];

//            foreach ($data['photos'] as $key => $value)
            //                if ($value['is_change']) {
            //                    $company->images()->whereId($key)->update(array_except($value, 'is_change'));
            //
            //                    (new \Modules\Utilities\CropImage(storage_app_path($value['image']), [parsePosition($value['position_x']), parsePosition($value['position_y'])], CompanyHasImage::$size[$value['type']]))->crop()->save();
            //                }

            return $company->save();
        });

    }

    public function removeImage($image, $id = null)
    {
        $company = $id ? $this->findById($id) : auth()->user()->seller->company;

        switch ($image) {
            case 'logo':
                $company->logo = '';
                $company->save();
                break;
            default:
                $company->images()->whereId($image)->update(['image' => '', 'position_x' => '0px', 'position_y' => '0px']);
                break;
        }
    }

    public function findBySlug($slug)
    {
        return $this->companyRepository->findBySlug($slug);
    }

    public function getPaginated($type = null)
    {
        return $this->companyRepository->getPaginated($type);
    }

    public function getCountOfCompanies($type = null)
    {
        $counts = [];
        $types = $type ? [$type => $type] : get_general_status();

        foreach ($types as $key => $value) {
            $counts[$key] = $this->companyRepository->getCompanyCountByStatus($key);
        }

        return $counts;
    }

    public function updateByAdmin($id, $data, $companyFiles, $images)
    {
        $company = $this->findById($id);
        $imagesPath = [];
        foreach ($companyFiles as $key => $file) {
            $data[$key] = $file->store('public/companies');
        }

        foreach ($images as $key => $file) {
            $imagesPath[$key] = $file->store('public/companies');
        }

        return \DB::transaction(function () use ($data, $imagesPath, $company) {
            $company->fill($data);
            foreach ($imagesPath as $key => $path) {
                $company->images()->whereId($key)->update(['image' => $path]);
            }

            $company->save();
        });
    }

    public function updateStatus($id, $status)
    {
        $company = $this->companyRepository->findById($id);
        $company->status = $status;
        $company->save();
        event(new CompanyStatusUpdated($company));

        return $company;
    }

    public function delete($id, $force = null, $reason = null)
    {
        $company = Company::withTrashed()->findOrFail($id);

        \DB::transaction(function () use ($company, $force, $reason) {

            $deleteType = $force ? 'forceDelete' : 'delete';

            FeaturedCategoriesHasProduct::whereIn('product_id', $company->products_obj->pluck('id'))->delete();

            $company->products_obj()->{$deleteType}();

            User::whereHas('seller', function ($query) use ($company) {
                return $query->where('company_id', $company->id);
            })
                ->update(['role' => User::OrdinaryUser]);

            if (!$force && $reason) {
                $company->delete_reason = $reason;

                $company->save();
            }

            $company->sellers()->{$deleteType}();

            $company->{$deleteType}();
        });

    }

    public function recover($id)
    {
        $company = $this->companyRepository->getTrashedItemById($id);

        return \DB::transaction(function () use ($company) {

            $company->delete_reason = null;

            $owner = $company->owner()->withTrashed()->first();

            if ($owner->role != User::OrdinaryUser) {
                return null;
            }

            $owner->role = User::MainSeller;

            $owner->save();

            $company->restore();

            $company->owner()->restore();

            $sellers = $company->sellers()->onlyTrashed()->whereNull('delete_reason')->where('user_id', '<>', $owner->id)->whereHas('user', function ($query) {
                return $query->where('role', User::OrdinaryUser);
            })->get();

            User::whereIn('id', $sellers->pluck('user_id'))
                ->update(['users.role' => User::AssociateSeller]);

            $company->sellers()->restore();

            $company->products_obj()->restore();
            $company->save();

            return $company;
        });
    }

    public function getTrashItems()
    {
        return $this->companyRepository->getTrashItems();
    }

    public function searchBar()
    {
        $request = request();

        return Company::onlyApproved()
            ->when($request->search, function ($query) use ($request) {
                $search = strtolower($request->search);

                $query->where(function ($q) use ($search) {
                    $q->where(\DB::raw('LOWER(name)'), 'LIKE', '%' . $search . '%');
                    $q->orWhere(\DB::raw('LOWER(products)'), 'LIKE', '%' . $search . '%');

                    $q->orWhereHas('products_obj', function ($query) use ($search) {

                        $query->where(\DB::raw('LOWER(name)'), 'LIKE', '%' . $search . '%');
                        $query->orWhere(\DB::raw('LOWER(model_number)'), 'LIKE', '%' . $search . '%');
                        $query->orWhere(\DB::raw('LOWER(brand_name)'), 'LIKE', '%' . $search . '%');
                        $query->orWhereHas('keywords', function ($q) use ($search) {
                            return $q->where(\DB::raw('LOWER(name)'), 'LIKE', '%' . $search . '%');
                        });

                        return $query;
                    });
                    return $q;
                });

                return $query;
            })
            ->when($request->city, function ($query) use ($request) {
                return $query->where('city', $request->city);
            })
            ->when($request->province, function ($query) use ($request) {
                return $query->where('province', $request->province);
            })
            ->when($request->country_id, function ($query) use ($request) {
                return $query->where('country_id', $request->country_id);
            })
            ->when($request->category, function ($query) use ($request) {
                $categories = $this->categoryRepository->getCategoryAndDescendantBySlug($request->category);

                return $query->whereHas('products_obj', function ($q) use ($categories) {
                    return $q->whereIn('category_id', $categories->pluck('id'));
                });
            })
            ->when($request->viber, function ($query) use ($request) {
                return $query->whereHas('owner.seller', function ($q) use ($request) {
                    return $q->whereNotNull('viber');
                });
            })
            ->when($request->whatsapp, function ($query) use ($request) {
                return $query->whereHas('owner.seller', function ($q) use ($request) {
                    return $q->whereNotNull('whatsapp');
                });
            })
            ->when($request->skype, function ($query) use ($request) {
                return $query->whereHas('owner.seller', function ($q) use ($request) {
                    return $q->whereNotNull('skype');
                });
            })
            ->when($request->wechat, function ($query) use ($request) {
                return $query->whereHas('owner.seller', function ($q) use ($request) {
                    return $q->whereNotNull('wechat');
                });
            })
            ->paginate($request->per_page ? $request->per_page : 20);
    }

    public function findBySlugAndApproved($slug)
    {
        return $this->companyRepository->findBySlugAndApproved($slug);
    }
}

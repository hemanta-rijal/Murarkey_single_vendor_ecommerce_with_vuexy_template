<?php

namespace Modules\Products\Services;

use App\Events\ProductCategoryChanged;
use App\Events\ProductStatusUpdated;
use App\Models\Product;
use App\Models\ProductHasAttribute;
use App\Models\ProductHasImage;
use App\Models\ProductHasKeyword;
use Modules\Categories\Contracts\CategoryRepository;
use Modules\Companies\Contracts\CompanyRepository;
use Modules\Products\Contracts\ProductRepository;
use Modules\Products\Contracts\ProductService as ProductServiceContract;

class ProductService implements ProductServiceContract
{
    const DEFAULT_PAGINATION = 10;
    protected $productRepository;
    protected $companyRepository;
    protected $categoryRepository;

    public function __construct(ProductRepository $productRepository, CompanyRepository $companyRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->companyRepository = $companyRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function create($data)
    {
        $data['company_id'] = $data['company_id'] ?? auth()->user()->seller->company_id;
        if (auth('admin')->user()) {
            $company = $this->companyRepository->findById($data['company_id']);
            // $data['seller_id'] = $data['seller_id'] ?? $company->owner->seller->id;
            $data['seller_id'] = $data['seller_id'] ?? $company->owner->id;
        } else {
            $data['seller_id'] = $data['seller_id'] ?? null;
        }

        return $this->productRepository->create($data);
    }

    public function createTemp($data)
    {
        $data['company_id'] = $data['company_id'] ?? auth()->user()->seller->company_id;

        if (auth('admin')->user()) {
            // $company = $this->companyRepository->findById($data['company_id']);
            // $data['seller_id'] = $data['seller_id'] ?? $company->owner->seller->id;
        } else {
            $data['seller_id'] = $data['seller_id'] ?? null;
        }

        return $this->productRepository->createTempProduct($data);
    }

    public function getPaginated($type = null, $search = null, int $number = null, $companyId = null, $userId = null)
    {
        return $this->productRepository
            ->getPaginated(
                $type, $search, $this->getPaginationConstant($number), $companyId, $userId
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function updateStatus($id, $status)
    {
        $product = $this->productRepository->findById($id);
        $product->status = $status;
        $product->save();
        event(new ProductStatusUpdated($product));

        return $product;
    }

    public function delete($id, $force = null, $companyId = null, $userId = null)
    {
        if ($force) {
            return $product = $this->productRepository->getTrashedItemById($id, $companyId, $userId)->forceDelete();
        } else {
            return $product = $this->productRepository->findProductWithCompanyIdAndUserId($id, $companyId, $userId)->delete();
        }

    }

    public function recover($id, $companyId = null, $userId = null)
    {
        $product = $this->productRepository->getTrashedItemById($id, $companyId, $userId);
        $product->restore();

        return $product;
    }

    public function getTrashItems($companyId = null, $userId = null)
    {
        return $this->productRepository->getTrashItems($companyId, $userId);
    }

    public function getProductCountByStatus($type = null, $companyId = null, $userId = null)
    {

        $counts = [];
        $types = $type ? [$type => $type] : get_general_status();

        foreach ($types as $key => $value) {
            $counts[$key] = $this->productRepository->getProductCountByStatus($key, $companyId, $userId);
        }
        // dd($counts);
        return $counts;
    }

    public function updateForSeller($id, $data)
    {
        $this->update($this->findByIdForSeller($id), $data);
    }

    public function update($product, $data)
    {
        $product = $product instanceof Product ? $product : $this->findById($product);
        $removeTypes = ['keyword', 'attribute', 'trade_info', 'image'];

        if (!isset($data['auction'])) {
            $data['auction'] = false;
        }

        if ($product->category_id != $data['category_id']) {
            event(new ProductCategoryChanged(['from' => $product->category_id, 'to' => $data['category_id']]));
        }

        \DB::transaction(function () use ($data, $product, $removeTypes) {
            //Remove Item
            foreach ($removeTypes as $type) {
                if (isset($data['remove_' . $type])) {
                    foreach ($data['remove_' . $type] as $keyword) {
                        $product->{$type . 's'}()->whereId($keyword)->delete();
                    }
                }
            }

            //Update Old keyword
            if (isset($data['old_keyword'])) {
                foreach ($data['old_keyword'] as $id => $keyword) {
                    if (isset($keyword['is_dirty']) && isset($keyword['value'])) {
                        $product->keywords()->whereId($id)->update(['name' => $keyword['value']]);
                    }
                }
            }

            //Update Old Attributes
            if (isset($data['old_attribute'])) {
                foreach ($data['old_attribute'] as $id => $attribute) {
                    if (isset($attribute['is_dirty']) && isset($attribute['value'])) {
                        $product->attributes()->whereId($id)->update(array_only($attribute, ['key', 'value']));
                    }
                }
            }

            //Update Old Trade info
            //            if (isset($data['old_moq']))
            //                foreach ($data['old_moq'] as $id => $moq)
            //                    if (isset($moq['is_dirty']) && isset($moq['moq']))
            //                        $product->trade_infos()->whereId($id)->update(array_only($moq, ['moq', 'price']));

            if (!auth('admin')->check()) {
                $data['status'] = 'pending';
            }

            $product->fill($data);
            $product->save();

            //Insert new keywords
            $attributes = [];
            $keywords = [];
//            $moqs = [];
            $images = [];

            if (isset($data['attribute'])) {
                foreach ($data['attribute'] as $attribute) {
                    $attributes[] = new ProductHasAttribute($attribute);
                }

                $product->attributes()->saveMany($attributes);
            }

            if (isset($data['keyword'])) {
                foreach ($data['keyword'] as $keyword) {
                    $keywords[] = new ProductHasKeyword(['name' => $keyword]);
                }

                $product->keywords()->saveMany($keywords);
            }

//            if (isset($data['moq'])) {
            //                foreach ($data['moq'] as $moq)
            //                    $moqs[] = new ProductHasTradeInfo($moq);
            //
            //                $product->trade_infos()->saveMany($moqs);
            //            }

            if (isset($data['images'])) {
                foreach ($data['images'] as $image) {
                    $images[] = new ProductHasImage(['image' => $image]);
                }

                $product->images()->saveMany($images);
            }
        });
    }

    public function findById(int $id)
    {
        return $this->productRepository->findById($id);
    }

    public function findByIdForSeller($id)
    {
        return auth()
            ->user()
            ->seller
            ->company
            ->products_obj()
            ->whereId($id)
            ->firstOrFail();
    }

    public function copy($id, $companyId = null, $userId = null)
    {
        $product = $this->productRepository->findProductWithCompanyIdAndUserId($id, $companyId, $userId);

        $product->loadBasicRelationship();

        $newProduct = $product->replicate(['status']);

        return \DB::transaction(function () use ($newProduct, $product) {
            $newProduct->save();

            foreach ($product::$relationship as $relation) {
                $items = [];
                if ($relation != 'reviews.user' && $product->{$relation}) {
                    foreach ($product->{$relation} as $item) {
                        $items[] = $item->replicate(['product_id']);
                    }

                    $newProduct->{$relation}()->saveMany($items);
                }
            }

            return $newProduct;
        });
    }

    public function emptyTrash($companyId, $userId)
    {
        return $this->productRepository->emptyTrash($companyId, $userId);
    }

    public function search($keywords, $category)
    {
        if ($category) {
            $categories = $this->categoryRepository->getCategoryWithChildrenAndParent($category);

            $products = $this->productRepository->searchByCategory($categories['searchIds']);
        } else {
            $products = $this->productRepository->search($keywords);
        }

        return $products;
    }

    public function searchWithCategory($search, $categoryId)
    {
        $categories = $this->categoryRepository->getCategoryAndChildren($categoryId)->pluck('id');

        return $this->productRepository->searchWithCategory($search, $categories);
    }

    public function updateFeatured($value, $productId, $companyId = null)
    {
        return $this->productRepository->updateFeatured($value, $productId, $companyId);
    }

    public function searchBar()
    {
        $request = request();
        Product::$searchOrderBy = false;

        $masterQuery = Product::onlyApproved()
            // ->where('auction', 0)
            ->when($request->category, function ($query) use ($request) {
                $categories = $this->categoryRepository->getCategoryAndDescendantBySlug($request->category);

                return $query->whereIn('products.category_id', $categories->pluck('id'));
            })
            ->when($request->lower_price, function ($query) use ($request) {
                return $query->where('price', '>', $request->lower_price);
            })
            ->when($request->upper_price, function ($query) use ($request) {
                return $query->where('price', '<', $request->upper_price);
            })
            ->when($request->city, function ($query) use ($request) {
                return $query->whereHas('company', function ($q) use ($request) {
                    return $q->where('city', $request->city);
                });
            })
            ->when($request->province, function ($query) use ($request) {
                return $query->whereHas('company', function ($q) use ($request) {
                    return $q->where('province', $request->province);
                });
            })
            
//            ->when($request->country_id, function ($query) use ($request) {
        //                return $query->whereHas('country_id', function ($q) use ($request) {
        //                    return $q->where('country_id', $request->country_id);
        //                });
        //            })
            ->when($request->search, function ($query) use ($request) {
                return $query->search($request->search, null, true)->groupBy('products.id', 'relevance');
            })
            ->when($request->order_by, function ($query) use ($request) {
                switch ($request->order_by) {
                    case 'lowest_price':
                        return $query->orderByRaw('price ASC');
                        break;
                    case 'highest_price':
                        return $query->orderByRaw('price DESC');
                        break;
                    case 'recently_added':
                        return $query->orderByRaw('created_at DESC');
                    default:
                }

                return $query;
            })
            ->when(!$request->search && !$request->order_by, function ($query) {
                return $query->orderByRaw('created_at DESC');
            })
            ->when($request->search && !$request->order_by, function ($query) {
                return $query->orderByRaw('relevance DESC');
            });
            
        return [
            'all_products' => $masterQuery->get(),
            'products' => $masterQuery->paginate($request->per_page ? $request->per_page : 20),
        ];
    }
    public function productBySlug(){
        $request = request();
        $searchTerm=  request()->search;
        // $attributes =['title','brand_name', 'place_of_origin','model_number'];
       
         $query = Product::onlyApproved()
                            // ->where(['title','brand_name', 'place_of_origin','model_number'], 'like', '%' . $slug . '%');
                            // ->whereLike(['title','brand_name', 'place_of_origin','model_number'],$slug)->get();
                                    
                            ->where('name', 'like', "%{$searchTerm}%")
                            ->where('slug', 'like', "%{$searchTerm}%")
                            ->orWhere('brand_name', 'like', "%{$searchTerm}%")
                            ->orWhere('place_of_origin', 'like', "%{$searchTerm}%")
                            ->orWhere('model_number', 'like', "%{$searchTerm}%");

        return [
            'all_products' => $query->get(),
            'products' => $query->paginate($request->per_page ? $request->per_page : 20),
        ];
        
    }
    public function updateOutOfStock($product_id, $out_of_stock, $company_id = null, $userId = null)
    {
        return $this->productRepository->updateOutOfStock($product_id, $out_of_stock, $company_id, $userId);
    }

    public function findByIdAndApproved($id)
    {
        return $this->productRepository->findByIdAndApproved($id);
    }

    public function findBySlugAndApproved($slug)
    {
        return $this->productRepository->findBySlugAndApproved($slug);
    }
}
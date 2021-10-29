<?php

namespace Modules\Companies\Repositories;

use App\Models\Company;
use App\Models\CompanyHasImage;
use Modules\Companies\Contracts\CompanyRepository;

class DbCompanyRepository implements CompanyRepository
{

    public function create($company)
    {
        $company = Company::create($company);

        for ($i = 0; $i < 6; $i++) {
            $images[] = new CompanyHasImage(['type' => 'company-photo']);
        }

        $images[] = new CompanyHasImage(['type' => 'cover-photo']);

        $company->images()->saveMany($images);

        return $company;
    }

    public function lists()
    {
        return Company::pluck('name', 'id');
    }

    public function findById($id)
    {
        return Company::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return Company::whereSlug($slug)->firstOrFail();
    }

    public function getPaginated($type = null)
    {
        return Company::when($type, function ($query) use ($type) {
            return $query->whereStatus($type);
        })
            ->when(request()->search, function ($query) {
                return $query->search(request()->search);
            })
            ->paginate();
    }

    public function getCompanyCountByStatus($key)
    {
        return Company::whereStatus($key)->count();
    }

    public function getTrashedItemById($id)
    {
        return Company::onlyTrashed()->whereId($id)->firstOrFail();
    }

    public function getTrashItems()
    {
        return Company::onlyTrashed()->paginate();
    }

    public function search($keywords)
    {
        return Company::onlyApproved()
            ->search(implode(' ', $keywords), true, true)
            ->get();
    }

    public function findBySlugAndApproved($slug)
    {
        return Company::onlyApproved()->whereSlug($slug)->firstOrFail();
    }
}

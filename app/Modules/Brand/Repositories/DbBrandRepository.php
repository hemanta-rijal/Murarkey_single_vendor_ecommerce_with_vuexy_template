<?php

namespace Modules\Brand\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\Schema;
use Modules\Brand\Contracts\BrandRepo;

class DbBrandRepository implements BrandRepo
{
    public function create($data): Brand
    {
        return Brand::create($data);
    }

    public function findById($id)
    {
        return Brand::findOrFail($id);
    }
    public function findBySlug($slug)
    {
        return Brand::where('slug', $slug)->first();
    }

    public function getAll()
    {
        return Brand::all();
    }
    public function update($id, $data)
    {
        return $this->findById($id)->update($data);
    }

    public function delete($id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated($number)
    {
        return Brand::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }
    public function getBrandWithProductCount($name=null)
    {
        return Brand::when($name, function ($query) use ($name) {
                return $query->where('name','like','%'.$name.'%');
            })
            ->get()->sortByDesc(function ($a) {
            return $a->products->count();
        });
    }

    public function findBy($column, $data)
    {

        if (Schema::hasColumn('brands', $column)) {
            return Brand::where($column, $data)->first();
        }
    }

}

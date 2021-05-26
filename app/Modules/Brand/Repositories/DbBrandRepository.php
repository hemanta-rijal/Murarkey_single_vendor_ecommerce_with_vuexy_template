<?php


namespace Modules\Brand\Repositories;


use App\Models\Brand;
use Modules\Brand\Contracts\BrandRepo;

class DbBrandRepository implements BrandRepo
{
    public function create($data) : Brand
    {
        return Brand::create($data);
    }

    public function findById($id)
    {
        return Brand::findOrFail($id);
    }
    
    public function getAll()
    {
        return Brand::all();
    }
    public function update($id, $data)
    {
        return  $this->findById($id)->update($data);
    }

    public function delete($id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated($number)
    {
        return Category::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }



}
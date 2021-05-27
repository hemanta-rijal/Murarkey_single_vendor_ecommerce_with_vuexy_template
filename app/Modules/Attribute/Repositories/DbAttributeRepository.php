<?php


namespace Modules\Attribute\Repositories;

use App\Models\Attribute;
use Modules\Attribute\Contracts\AttributeRepository;

class DbAttributeRepository implements AttributeRepository
{
    public function create($data) : Attribute
    {
        return Attribute::create($data);
    }

    public function findById($id)
    {
        return Attribute::findOrFail($id);
    }
    
    public function getAll()
    {
        return Attribute::all();
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
        return Attribute::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}
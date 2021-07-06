<?php

namespace Modules\Service\Repositories;

use App\Models\Service;
use Modules\Service\Contracts\ServiceRepository;

class DbServiceRepository implements ServiceRepository
{
    public function create($data): Service
    {
        return Service::create($data);
    }

    public function findById($id)
    {
        return Service::findOrFail($id);
    }
    public function findBySlug($slug)
    {
        return Service::where('slug', $slug)->get();
    }

    public function getAll()
    {
        return Service::all();
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
        return Category::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}

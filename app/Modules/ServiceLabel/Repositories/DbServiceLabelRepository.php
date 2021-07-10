<?php

namespace Modules\ServiceLabel\Repositories;

use App\Models\ServiceLabel;
use Modules\ServiceLabel\Contracts\ServiceLabelRepository;

class DbServiceLabelRepository implements ServiceLabelRepository
{
    public function create($data): ServiceLabel
    {
        return ServiceLabel::create($data);
    }

    public function findById($id)
    {
        return ServiceLabel::findOrFail($id);
    }

    public function getAll()
    {
        return ServiceLabel::all();
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
        return ServiceLabel::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}

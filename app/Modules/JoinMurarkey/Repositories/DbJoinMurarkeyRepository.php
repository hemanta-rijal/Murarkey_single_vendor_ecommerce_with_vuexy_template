<?php

namespace Modules\JoinMurarkey\Repositories;

use App\Models\JoinMurarkey;
use Modules\JoinMurarkey\Contracts\JoinMurarkeyRepository;

class DbJoinMurarkeyRepository implements JoinMurarkeyRepository
{
    public function create($data): JoinMurarkey
    {
        return JoinMurarkey::create($data);
    }

    public function findById($id)
    {
        return JoinMurarkey::findOrFail($id);
    }

    public function getAll()
    {
        return JoinMurarkey::all();
    }
    public function update($id, $data)
    {

        $JoinMurarkey = $this->findById($id);

        \DB::transaction(function () use ($JoinMurarkey, $data) {
            $JoinMurarkey->fill($data);
            return $JoinMurarkey->save();
        });

    }

    public function delete($id)
    {
        $model = $this->findById($id);

        return $model->delete();
    }

    public function getPaginated($number)
    {
        return JoinMurarkey::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}

<?php

namespace Modules\Currency\Repositories;

use App\Models\Currency;
use Modules\Currency\Contracts\CurrencyRepository;

class DbCurrencyRepository implements CurrencyRepository
{
    public function create($data): Currency
    {
        return \DB::transaction(function () use ($data) {
            $currency = Currency::create($data);
            return $currency;
        });

    }

    public function findById($id)
    {
        return Currency::findOrFail($id);
    }

    public function getAll()
    {
        return Currency::all();
    }
    public function update($id, $data)
    {
        return \DB::transaction(function () use ($id, $data) {
            return $this->findById($id)->update($data);
        });

        return $this->findById($id)->update($data);
    }

    public function delete($id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated($number)
    {
        return Currency::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}

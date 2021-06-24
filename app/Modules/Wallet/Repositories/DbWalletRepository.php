<?php

namespace Modules\Wallet\Repositories;

use App\Models\Wallet;
use Modules\Wallet\Contracts\WalletRepository;

class DbWalletRepository implements WalletRepository
{
    public function create($data): Wallet
    {
        return Wallet::create($data);
    }

    public function findById($id)
    {
        return Wallet::findOrFail($id);
    }

    public function getAll()
    {
        return Wallet::all();
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
        return Wallet::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}

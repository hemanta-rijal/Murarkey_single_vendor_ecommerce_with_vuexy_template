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
    public function getWalletTotalAmountByUser($user){
        if(Wallet::where('user_id',$user->id)->count()>0){
            return (int)  Wallet::where('user_id',$user->id)->orderBy('created_at','desc')->first()->total_amount;
        }
        return 0;
    }
    public function checkTransactionPayable($user,$amount){
        if($this->getWalletTotalAmountByUser($user)>$amount){
            return true;
        }
        return false;
    }

}

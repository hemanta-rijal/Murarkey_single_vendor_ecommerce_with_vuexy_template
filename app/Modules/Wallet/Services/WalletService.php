<?php

namespace Modules\Wallet\Services;

use App\Events\UpdateWalletTransaction;
use App\Models\Wallet;
use Modules\Wallet\Contracts\WalletRepository;
use Modules\Wallet\Contracts\WalletService as WalletServiceContract;

class WalletService implements WalletServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $walletRepository;

    public function __construct(WalletRepository $repository)
    {
        $this->walletRepository = $repository;
    }

    public function getAll()
    {
        return wallet::orderBy('created_at', 'desc')->get();
    }
    public function getAllByUserId($id)
    {
        return wallet::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public function create($data): wallet
    {
        $data['total_amount'] = $this->getWalletAmountByUser($data['user_id']);
        $wallet = $this->walletRepository->create($data);
        event(new UpdateWalletTransaction($wallet));
        return $wallet;
    }

    public function update($id, $data)
    {
        return $this->walletRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->walletRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->walletRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->walletRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }
    public function setWalletRequest($user_id,$amount,$paymentMethod,$transaction_type,$description,$status){
        return [
            'user_id'=>$user_id,
            'amount'=>$amount,
            'payment_method'=>$paymentMethod,
            'transaction_type'=>$transaction_type,
            'description'=>$description,
            'status'=>$status
        ];
    }
    public function getWalletAmountByUser($user_id){
        return $this->walletRepository->getWalletTotalAmountByUser($user_id);
    }
    public function checkTransactionPayable($user,$amount){
        return $this->walletRepository->checkTransactionPayable($user,$amount);
    }
    public function orderUsingWallet($totalOrder,$user_id){
        $data = [
            'user_id'=>$user_id,
            'payment_method'=>'order',
            'transaction_type'=>'debit',
            'description'=>'Used while order',
            'status'=>1
        ];
        $totalBalance =$this->walletRepository->getWalletTotalAmountByUser($user_id);
        if ($totalBalance>$totalOrder){
            $data['amount']= $totalOrder;
            $data['total_amount']= $totalBalance-$totalOrder;
        }else{
            $data['amount'] = $totalBalance;
            $data['total_amount']= 0.00;
        }
        return $this->walletRepository->create($data);
    }
}

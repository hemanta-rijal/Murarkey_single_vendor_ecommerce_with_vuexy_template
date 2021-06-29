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
        $data['total_amount'] = calculateUsersWalletTotal($data['user_id'], $data['transaction_type'], $data['amount']);
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
    public function getWalletAmountByUser($user){
        return $this->walletRepository->getWalletTotalAmountByUser($user);
    }
    public function checkTransactionPayable($user,$amount){
        return $this->walletRepository->checkTransactionPayable($user,$amount);
    }

}

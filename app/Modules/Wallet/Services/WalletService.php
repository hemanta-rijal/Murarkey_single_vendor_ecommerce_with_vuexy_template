<?php

namespace Modules\Wallet\Services;

use App\Events\UpdateUserDetail;
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
        event(new UpdateUserDetail($wallet));
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

}

<?php

namespace Modules\Wallet\Services;

use App\Events\UpdateUserDetail;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
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

    public function create($data): wallet
    {
        $user = Auth::guard('web')->user();
        // dd($user->wallet);
        $data['user_id'] = $user->id;
        if ($data['payment_method'] == 'esewa') {
            $data['description'] = ' loaded successfully';
        } elseif ($data['payment_method'] == 'esewa') {
            // $data['description'] = 'Balance loaded successfully from esewa';
            $data['description'] = 'loaded successfully';
        }
        $data['transaction_type'] = 'credit';
        if ($user->wallet->first()) {
            $data['total_amount'] = $user->wallet->first()->total_amount + $data['amount'];
        } else {
            $data['total_amount'] = 0;
        }
        $data['status'] = true;
        // dd($data);
        return $wallet = $this->walletRepository->create($data);
        event(new UpdateUserDetail($wallet));
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

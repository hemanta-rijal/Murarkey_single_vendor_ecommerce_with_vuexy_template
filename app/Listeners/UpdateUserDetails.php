<?php

namespace App\Listeners;

use App\Events\UpdateUserDetail;
use Illuminate\Support\Facades\Auth;
use Modules\Wallet\Services\WalletService;

class UpdateUserDetails
{

    protected $walletService;
    protected $user;
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
        $this->user = Auth::guard('web')->user();

    }

    /**
     * Handle the event.
     *
     * @param  UpdateUserDetail  $event
     * @return void
     */
    public function handle(UpdateUserDetail $event)
    {
        $user = Auth::guard('web')->user();

        $path = public_path('userdetails\userdetail.csv');
        $file = fopen($path, 'a+');
        foreach ($user->wallet as $wallet) {
            fputcsv($file, $wallet->backupdata());
        }
        fclose($file);
    }
}

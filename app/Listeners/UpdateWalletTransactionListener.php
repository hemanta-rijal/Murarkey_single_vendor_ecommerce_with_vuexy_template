<?php

namespace App\Listeners;

use App\Events\UpdateWalletTransaction;
use App\Models\User;
use Modules\Wallet\Services\WalletService;

class UpdateWalletTransactionListener
{

    protected $walletService;
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    /**
     * Handle the event.
     *
     * @param  UpdateWalletTransactionListener  $event
     * @return void
     */
    public function handle(UpdateWalletTransaction $event)
    {
        $user = User::find($event->wallet->user_id);
        $path = public_path('userdetails\userdetail.csv');
        $file = fopen($path, 'a+');
        foreach ($user->wallet as $wallet) {
            fputcsv($file, $wallet->backupdata());
        }
        fclose($file);
    }
}

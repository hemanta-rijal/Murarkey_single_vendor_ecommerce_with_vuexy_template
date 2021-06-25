<?php

namespace App\Listeners;

use App\Events\UpdateUserDetail;
use App\Models\User;
use Modules\Wallet\Services\WalletService;

class UpdateUserDetails
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
     * @param  UpdateUserDetail  $event
     * @return void
     */
    public function handle(UpdateUserDetail $event)
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

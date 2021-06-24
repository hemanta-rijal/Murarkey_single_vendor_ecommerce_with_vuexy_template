<?php

namespace App\Listeners;

use App\Events\UpdateUserDetail;
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
        $wallet_details = $this->walletService->getAll();
        $file = fopen(public_path('userdetails\userdetail.csv'), 'w');
        foreach ($wallet_details as $row) {
            fputcsv($file, $row->to_array());
        }
        fclose($file);
    }
}

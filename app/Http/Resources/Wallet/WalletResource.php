<?php

namespace App\Http\Resources\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $logo = $this->payment_method == 'esewa' ? URL::asset('frontend/img/esewa.png') : ($this->payment_method == 'khalti' ? URL::asset('frontend/img/khalti.jpg') : ($this->payment_method == 'paypal' ? URL::asset('frontend/img/paypal.png') : URL::asset('frontend/img/wallet.png')));
        $data = [
            'user_id' => $this->user_id,
            'transaction_type' => $this->transaction_type,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'remarks' => [
                'logo' => $logo,
                'text' => $this->description,
            ],
            'loadedOn' => $this->created_at->format('d,M-Y h:i A'),

        ];
        // $data['total_wallet_balance'] = getWalletTotal(auth()->user());
        return $data;
    }
}

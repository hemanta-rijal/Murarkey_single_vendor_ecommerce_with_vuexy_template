<?php

namespace App\Http\Resources\Wallet;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
        // return $this->backupdata();
        return [
            'user_id' => new UserResource($this->user_id),
            'transaction_type' => $this->transaction_type,
            'payment_method' => $this->payment_method,
            'description' => $this->description,
            'amount' => $this->amount,
            'status' => $this->status,
            'total_amount' => $this->total_amount,

        ];

    }
}

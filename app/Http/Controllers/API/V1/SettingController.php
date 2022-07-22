<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SettingController extends Controller
{
    public function getPaymentMethods(){
        $data =[
        [
                'name'=>'Cash On Delivery',
                'status'=>1,
                'imageUrl'=>URL::asset('frontend/img/cod.png')
        ],
        [
            'name'=>'Esewa',
            'status'=>1,
            'imageUrl'=>URL::asset('frontend/img/esewa.png')
        ],[
            'name'=>'Paypal',
            'status'=>1,
            'imageUrl'=>URL::asset('frontend/img/payapl.png')
        ],[
            'name'=>'Wallet',
            'status'=>1,
            'imageUrl'=>URL::asset('frontend/img/wallet.png')
        ]
        ];
        return response()->json(['data'=>$data,'message'=>'APi fetch Successfully','status'=>200]);
    }
}

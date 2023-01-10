<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SettingController extends Controller
{
    /**
     * Json that returns active payments methods
     * @return JsonResponse
     */
    public function getPaymentMethods(): \Illuminate\Http\JsonResponse
    {
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
        ]
        ];
        return response()->json(['data'=>$data,'message'=>'APi fetch Successfully','status'=>200]);
    }

    /**
     * Json that returns the quick facts : ref: just after the banner in website
     * @return JsonResponse
     */
    public function quickFeature(): \Illuminate\Http\JsonResponse
    {
        $data =[
            [
                'name'=>'FREE SHIPPING',
                'description'=>'Inside Ring road',
                'imageUrl'=>URL::asset('frontend/img/icon-1.png')
            ],
            [
                'name'=>'100% AUTHENTIC',
                'description'=>'Directly from Brand',
                'imageUrl'=>URL::asset('frontend/img/icon-2.png')
            ],
            [
                'name'=>'HOME SERVICES',
                'description'=>'Wide Range',
                'imageUrl'=>URL::asset('frontend/img/icon-1.png')
            ],
            [
                'name'=>'5% CASHBACK',
                'description'=>'On Every Purchase',
                'imageUrl'=>URL::asset('frontend/img/icon-2.png')
            ],
        ];
        return response()->json(['data'=>$data,'message'=>'APi fetch Successfully','status'=>200]);
    }
}

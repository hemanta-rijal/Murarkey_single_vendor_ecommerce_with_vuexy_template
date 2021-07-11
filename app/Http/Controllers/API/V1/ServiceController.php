<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
   public function services(){
       $services =  [
           [
               'id'=>1,
               'name'=>'makeup at home',
               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
               'services'=>[
                   [
                       'id'=>5,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>15,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>16,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>17,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                       ]
                   ],
                   [
                       'id'=>6,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>18,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>19,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>20,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                       ]
                   ],
                   [
                       'id'=>7,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>21,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>22,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>23,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                       ]
                   ],
                   [
                       'id'=>8,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>24,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],

                       ]
                   ],
               ]
           ],
           [
               'id'=>2,
               'name'=>'bridal at home',
               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
               'services'=>[
                   [
                       'id'=>9,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>25,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>26,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>27,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],

                       ]
                   ],
                   [
                       'id'=>10,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>28,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>29,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>30,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],

                       ]
                   ],
                   [
                       'id'=>11,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=> [
                           [
                               'id'=>31,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>32,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                       ]
                   ],

               ]
           ],
           [
               'id'=>3,
               'name'=>'groom at home',
               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
               'services'=>[
                   [
                       'id'=>12,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>33,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>34,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                       ]
                   ],
                   [
                       'id'=>13,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>35,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>36,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                       ]
                   ],
                   [
                       'id'=>14,
                       'name'=>'hair saloon',
                       'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                       'services'=>[
                           [
                               'id'=>37,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                           [
                               'id'=>38,
                               'name'=>'hair saloon',
                               'icon'=>'https://newweb.murarkey.com/image/cache/200X200/xmnLKFy5HZMVormi22iMFlJF57E5d8xceHmmUYMd.jpg',
                           ],
                       ]
                   ],
               ]
           ]
       ];
       return response()->json(['data'=>$services]);
   }
}

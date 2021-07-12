<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function autocompleteSearch(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $services = Service::orderby('title', 'asc')->select('id', 'title', 'price', 'slug')->limit(5)->get();
        } else {
            $services = Service::orderby('title', 'asc')->select('id', 'title', 'price', 'slug')->where('title', 'like', '%' . $search . '%')->limit(5)->get();
        }
        $response = array();
        if ($services->count() > 0) {
            foreach ($services as $service) {
                $url = URL::to('service-detail/' . $service->id);
                $image = $srvice->featured_image ? resize_image_url($srvice->featured_image, '50X50') : null;
                $response[] = array("id" => $srvice->id, "name" => $srvice->name, "value" => $srvice->name, "label" => "<a href='$url'><img src='$image'> &nbsp; $service->title &nbsp; &nbsp; <strong>Rs. $service->price</strong></a>");
            }
        } else {
            $response[] = array("value" => '', 'label' => 'No Result Found');
        }

        return response()->json($response);
    }
}

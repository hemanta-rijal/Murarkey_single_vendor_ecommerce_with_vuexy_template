<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\ParlourListings\Contracts\ParlourListing;

class ParlourController extends Controller
{
    protected $parlourService;

    public function __construct(ParlourListing $parlourListing)
    {
        $this->parlourService = $parlourListing;
    }

    public function parlourPage()
    {
        return view('frontend.parlour.index')->with('parlours', $this->parlourService->filterParlour());
    }
    public function parlourInfo($slug)
    {
        $parlour = $this->parlourService->findBySlug($slug);
        if ($parlour) {
            return view('frontend.parlour.parlour')->with(compact('parlour'));
        }
    }
}

<?php
namespace App\Http\ViewComposer;

use App\Models\ThemeSetting;
use Illuminate\View\View;

class HomeComposer
{

    function get_slides(View $view)
    {
        $service = app(\Modules\Admin\Contracts\SliderService::class);
        static $slides;
        if ($slides == null) {
            $slides = $service->getSlides();
        }
        $view->with('slides', $slides);
    }
    function get_flashSales(View $view)
    {
       $flashSale = \App\Models\FlashSale::where('start_time', '<=', \Carbon\Carbon::now())->where('end_time', '>=', \Carbon\Carbon::now())->where('published', 1)->orderBy('weight', 'DESC')->get();
        if ($flashSale) {
            $flashSale->load('items.product.flash_sale_item', 'items.product.images');
            $view->with('flashSales', $flashSale);
        }
    }

    public function themeSetting(View $view){
        $themeSetting = ThemeSetting::all();
        dd($themeSetting);
         $view->with('themeSetting', $themeSetting);
    }
    
}

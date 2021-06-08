<?php
namespace App\Http\ViewComposer;

use App\Models\Category;
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
    function getFeatureCategory(View $view){
        $service = app(\Modules\Categories\Contracts\CategoryService::class);
        static $category;
        if($category==null){
            $category= $service->getFeaturedCategory();
        }
        $view->with('categories',$category);
    }

    function getFeatureParlor(View $view){
        $service = app(\Modules\ParlourListings\Contracts\ParlourListing::class);
        static $parlor;
        if($parlor==null){
            $parlor = $service->getFeatureListing();

        }

        $view->with('parlors',$parlor);
    }

    function getFeaturedBrand(View $view){
        $service = app(\Modules\Brand\Contracts\BrandServiceRepo::class);
        static $brand;
        if($brand==null){
            $brand= $service->getAll();
        }
        $view->with('brands',$brand);
    }
    function getServiceScheduleBanner(View $view){
        $service = app(\Modules\Admin\Contracts\BannerService::class);
        static $banner;
        if($banner==null){
            $banner = $service->getSliderByPosition('service-schedule');
        }
        $view->with('banners',$banner);
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

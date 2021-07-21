<?php
namespace App\Http\ViewComposer;

use App\Models\ThemeSetting;
use Illuminate\View\View;

class HomeComposer
{

    public function getHeaderMenu(View $view)
    {
        $menu = getMenuItemByType(get_theme_setting_by_key('primary_menu'));
        if ($menu->count() > 0) {
            // dd($menu->items);
            $view->with('header_menu', $menu->items);
        }else{
            $view->with('header_menu', null);
        }
    }

    public function get_slides(View $view)
    {
        $service = app(\Modules\Admin\Contracts\SliderService::class);
        static $slides;
        if ($slides == null) {
            $slides = $service->getSlides();
        }
        $view->with('slides', $slides);
    }
    public function getFeatureCategory(View $view)
    {
        $service = app(\Modules\Categories\Contracts\CategoryService::class);
        static $category;
        if ($category == null) {
            $category = $service->getFeaturedCategories();
        }
        $view->with('categories', $category);
    }

    public function getFeatureParlor(View $view)
    {
        $service = app(\Modules\ParlourListings\Contracts\ParlourListing::class);
        static $parlor;
        if ($parlor == null) {
            $parlor = $service->getFeatureListing();
        }
        $view->with('parlors', $parlor);
    }

    public function getFeaturedBrand(View $view)
    {
        $service = app(\Modules\Brand\Contracts\BrandServiceRepo::class);
        static $brands;
        $brands = $service->getAllFeatured();
        if ($brands->count() <= 2) {
            $brands = $service->getAll();
        }
        $view->with('brands', $brands);
    }

    public function getFeatureServices(View $view)
    {
        $service = app(\Modules\Service\Contracts\ServiceRepository::class);
        static $services;
        $services = $service->getAll(); //featured to be pulled
        if ($services == null) {
            $services = $service->getAll();
        }
        $view->with('services', $services);
    }

    public function getServiceScheduleBanner(View $view)
    {
        $service = app(\Modules\Admin\Contracts\BannerService::class);
        static $banner;
        if ($banner == null) {
            $banner = $service->getSliderByPosition('service-schedule');
        }
        $view->with('banners', $banner);
    }

    public function get_flashSales(View $view)
    {
        $flashSale = \App\Models\FlashSale::where('start_time', '<=', \Carbon\Carbon::now())->where('end_time', '>=', \Carbon\Carbon::now())->where('published', 1)->orderBy('weight', 'DESC')->get();
        if ($flashSale) {
            $flashSale->load('items.product.flash_sale_item', 'items.product.images');
            $view->with('flashSales', $flashSale);
        }
    }

    public function themeSetting(View $view)
    {
        $themeSetting = ThemeSetting::all();
        $view->with('themeSetting', $themeSetting);
    }

    public function contactUs(View $view)
    {
        $products = app(\Modules\Products\Contracts\ProductService::class)->getProductCountByStatus()['approved'];
        $brands = app(\Modules\Brand\Contracts\BrandServiceRepo::class)->getAll()->count();
        $testiService = app(\Modules\Testimonial\Contracts\TestimonialService::class);
        $testimonials = $testiService->getAll();
        $services = app(\Modules\ParlourListings\Contracts\ParlourListing::class)->getAll()->count();
        $faqs = app(\Modules\Faq\Contracts\FaqServiceRepository::class)->getAll();
        $view->with([
            'faqs' => $faqs,
            'testimonials' => $testimonials,
            'approvedProductCount' => $products,
            'brandCount' => $brands,
            'parlourListingCount' => $services,
        ]);
    }
}

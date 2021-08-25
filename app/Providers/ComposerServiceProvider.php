<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //  View::composer('home','App\Http\ViewComposer\HomeComposer@get_slides');
        //     View::composer('home','App\Http\ViewComposer\HomeComposer@get_flashSales');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.includes.header', 'App\Http\ViewComposer\HomeComposer@getHeaderMenu');
//        View::composer('frontend.includes.banner','App\Http\ViewComposer\HomeComposer@get_slides');
        View::composer('home', 'App\Http\ViewComposer\HomeComposer@get_flashSales');
        View::composer('frontend.partials.categorySlider', 'App\Http\ViewComposer\HomeComposer@getFeatureCategory');
        View::composer('frontend.partials.parlorListing', 'App\Http\ViewComposer\HomeComposer@getFeatureParlor');
        View::composer('frontend.partials.parlorListing', 'App\Http\ViewComposer\HomeComposer@getFeatureParlor');
        View::composer('frontend.partials.brandSlider', 'App\Http\ViewComposer\HomeComposer@getFeaturedBrand');
        View::composer('frontend.partials.serviceListing', 'App\Http\ViewComposer\HomeComposer@getFeatureServices');
        View::composer('frontend.parlour.parlour', 'App\Http\ViewComposer\HomeComposer@getFeatureServices');
        //        View::composer('frontend.partials.serviceSchedule','App\Http\ViewComposer\HomeComposer@getServiceScheduleBanner');
        // View::composer('home','App\Http\ViewComposer\HomeComposer@themeSetting');
        View::composer('frontend.contact-us', 'App\Http\ViewComposer\HomeComposer@contactUs');
    }
}

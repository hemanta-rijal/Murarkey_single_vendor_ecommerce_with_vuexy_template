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
        View::composer('home','App\Http\ViewComposer\HomeComposer@get_slides');
        View::composer('home','App\Http\ViewComposer\HomeComposer@get_flashSales');
        // View::composer('home','App\Http\ViewComposer\HomeComposer@themeSetting');
    }
}

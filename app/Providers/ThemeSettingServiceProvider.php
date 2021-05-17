<?php

namespace App\Providers;

use App\Models\ThemeSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ThemeSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('theme_settings')) {
            $setting = ThemeSetting::all([
                'key','value'
                ])
                ->keyBy('key') // key every setting by its name
                ->transform(function ($setting) {
                return $setting->value; // return only the value
                })
                ->toArray();
            \Config::set('themeSetting', $setting);
        }
    }
}

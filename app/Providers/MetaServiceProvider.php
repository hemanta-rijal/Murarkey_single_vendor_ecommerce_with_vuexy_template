<?php

namespace App\Providers;

use App\Models\Meta;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MetaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('metas')){
            $setting = Meta::all([
                'key','value'
            ])
                ->keyBy('key') // key every setting by its name
                ->transform(function ($setting) {
                    return $setting->value; // return only the value
                })
                ->toArray();
            \Config::set('systemSetting', $setting);
        }
    }
}

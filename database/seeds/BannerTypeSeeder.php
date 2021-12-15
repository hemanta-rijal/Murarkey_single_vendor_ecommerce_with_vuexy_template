<?php

use App\Models\Meta;
use Illuminate\Database\Seeder;

class BannerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Meta::findByKey('banner_type')) {
            Meta::create([
                'key' => 'banner_type',
                'value' => 'desktop,mobile_responsive,mobile_app',
                'description' => 'Banner Type'
            ]);
        } else {
            Meta::where('key', 'banner_type')->update([
                'key' => 'banner_type',
                'value' => 'desktop,mobile_responsive,mobile_app,updated',
                'description' => 'Banner Type'
            ]);
        }

    }
}

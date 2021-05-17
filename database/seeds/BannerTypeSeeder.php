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
        if (!Meta::findByKey('banner_type'))
            Meta::create([
                'key' => 'banner_type',
                'value' => 'homepage-1,homepage-2,product-details,user-dashboard,login-page',
                'description' => 'Banner Type'
            ]);
    }
}

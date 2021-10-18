<?php

use App\Models\ThemeSetting;
use Illuminate\Database\Seeder;

class ThemeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $settings = "first_ad_status,first_ad_link,first_ad_image,second_ad_status,second_ad_link,second_ad_image,third_ad_status,third_ad_link,third_ad_image,fourth_ad_status,fourth_ad_link,fourth_ad_image,fifth_ad_status,fifth_ad_link,fifth_ad_image,flash_sales_status,max_number_of_flash_sale_item,products_below_1500_status,max_number_of_item_on_products_below_1500,featured_products_status,you_may_like_products_status,max_number_of_you_may_like_items,new_arrivals_status,max_number_of_items_on_new_arrivals,first_featuring_showcase,second_featuring_showcase,third_featuring_showcase,forth_featuring_showcase,primary_menu,site_links_menu,quick_links_menu,normal_skin_image,dry_skin_image,oily_skin_image";

    public function run()
    {
        $settings = explode(',', $this->settings);
        foreach ($settings as $setting) {
            $dbSetting = ThemeSetting::where('key', $setting)->first();

            if (is_null($dbSetting)) {
                ThemeSetting::create([
                    'key' => $setting,
                    'value' => 'please change it',
                    'description' => 'Auto Generated',
                ]);
            }
        }
    }
}

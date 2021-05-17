<?php

use App\Models\Meta;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use App\Models\LocationCountry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $seller_user = User::where('role', '!=', 'ordinary-user')->get()->random();
        $faker = \Faker\Factory::create('ne_NP');
        \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);
        for ($i = 0; $i<=500; $i++) {
            $name = $faker->productName;
            $slug = str_replace(" ", "-", strtolower($name));
            $price = rand(200,10000);
            $discount = rand(20,100);
                DB::table('products')
                ->insert([
                    'name' => $name,
                    'model_number' => $faker->promotionCode,
                    'brand_name' => $faker->company,
                    'place_of_origin' => LocationCountry::all()->random()->id,
                    'details' => $faker->realText(3000, 2),
                    'shipping_details' => $faker->realText(2000, 5),
                    'packing_details' => $faker->realText(800, 2),
                    'unit_type' => Meta::where('key', 'unit_type')->first()->id,
                    'seller_id' => $seller_user->id,
                    'company_id' => $seller_user->company ? $seller_user->company->id : Company::all()->random()->id,
                    'featured' => true,
                    'category_id' => Category::all()->random()->id,
                    'status' => 'approved',
                    // 'created_at' => 'women'. $faker->name,
                    'out_of_stock' => false,
                    'assembled_in' => LocationCountry::all()->random()->id,
                    'made_in' => LocationCountry::all()->random()->id,
                    'slug' => $slug,
                    'size_chart' => $name,
                    'a_discount_price' => $discount,
                    'price' => $price,
                ]);

            $product_id = DB::getPdo()->lastInsertId();
            for($j=0; $j<=3; $j++){
                DB::table('product_has_images')
                ->insert([
                    'image' => $faker->randomElement(array(
                       
                        'public/products/3NhFTrJffeV0bUaj6V1X327jHYtIShM3qRxpnCE5.jpeg',
                        'public/products/7Xqmxshtz7Ubp3RFyvmTCvrfd3dmtv6yzWULPX8Y.jpeg',
                        'public/products/jRnywhW6F6n9gdlZ7FP5hKZ6fp6gIwqXK62eTS1I.jpeg',
                        'public/products/KxzK00dPbDL8b2loOIDDJ3I5SwhWnHcWKnMtnxqw.jpeg',
                        'public/products/ofN72U8Uo22PxtGJeOLwLUxNwv4qUsWRJQKkejpe.jpeg',
                        'public/products/4y_rsde-ss-600x600.jpg',
                        'public/products/81osqcTm9OL._SY445_.jpg',
                        'public/products/1006a.jpg',
                        'public/products/0003160401212_2_A1C1_0600.png',
                        'public/products/c6050189a5b7527595f2a1094a27171b.jpg',
                        'public/products/Donation-Products-FOOD-600x600-1-1.jpg',
                        'public/products/HULAS-MANSULI-RICE-600x600.jpg',
                        'public/products/l58694.jpg',
                        'public/products/product-1598013076508.jpg',
                        'public/products/rado-watch-in-nepal-600x600.webp',
                        'public/products/slim_fit_t_shirt.jpg',
                        'public/products/three-600x600.jpg',
                        'public/products/TISSUE_BOXES_plains_group_1.webp',
                        'public/products/Xiaomi_amazefit_pace_smart_watch.jpg',
                        'public/products/chocopie.png',
                        'public/products/combo.png',
                        'public/products/deal1.png',
                        'public/products/deal2.png',
                        'public/products/samsung.png',
                        'public/products/Tablet.png',
                    )),
                    'caption' => $name,
                    'product_id' => $product_id,
                    ]);
            }

            for($k=0; $k<= rand(5,15); $k++){
               DB::table('reviews')
                ->insert([
                    'user_id'=>User::where('role','ordinary-user')->get()->random()->id,
                    'rating'=>rand(1,5),
                    'comment'=>$faker->realText(20,1),
                    'product_id'=>$product_id,
                ]); 
            }


        }
    }

}
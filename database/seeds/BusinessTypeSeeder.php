<?php

use App\Models\Meta;
use Illuminate\Database\Seeder;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Meta::findByKey('business_type'))
            Meta::create([
                'key' => 'business_type',
                'value' => 'Trading Company,Distributor / Wholesaler,Other',
                'description' => 'Business Type'
            ]);
    }
}

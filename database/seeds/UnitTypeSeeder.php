<?php

use App\Models\Meta;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dbMeta = Meta::where('key', 'unit_type')->first();

        if (is_null($dbMeta))
            Meta::create([
                'key' => 'unit_type',
                'value' => 'kilogram,kilohertz,Meter,Ampere,Case',
                'description' => 'Auto Generated'
            ]);
    }
}

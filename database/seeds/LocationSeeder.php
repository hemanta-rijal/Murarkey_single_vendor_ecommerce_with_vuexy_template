<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(9000);

        $this->seedCountries(); //246 countries
        $this->seedCities(); // 48314 cities there is a proble while seeding states so I did manully.
        $this->seedStates(); //4120 states there is a proble while seeding states so I did manully.
    }

    public function seedCountries()
    {
        $path = resource_path('data/countries.sql');
        DB::table('location_countries')->truncate();
        DB::insert(explode(';', file_get_contents($path))[1]);
    }

    public function seedStates()
    {
        $path = resource_path('data/states.sql');
        DB::table('location_states')->truncate();
        $inserts = explode(';', file_get_contents($path));
        unset($inserts[0]);
        foreach ($inserts as $insert) {
            if ($insert != "\n") {
                DB::insert($insert);
            }
        }

    }

    public function seedCities()
    {
        $path = resource_path('data/cities.sql');
        DB::table('location_cities')->truncate();
        $inserts = explode(';', file_get_contents($path));
        unset($inserts[0]);

        foreach ($inserts as $insert) {
            if ($insert != "\n") {
                DB::insert($insert);
            }
        }

    }
}

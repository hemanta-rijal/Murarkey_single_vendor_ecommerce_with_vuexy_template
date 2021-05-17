<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //countries
        $path = resource_path('data/countries.sql');
        \DB::statement(explode(';', file_get_contents($path))[0]);
        //states
        $path = resource_path('data/states.sql');
        \DB::statement(explode(';', file_get_contents($path))[0]);
        //cities
        $path = resource_path('data/cities.sql');
        \DB::statement(explode(';', file_get_contents($path))[0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_countries');
        Schema::dropIfExists('location_states');
        Schema::dropIfExists('location_cities');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductCountToLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_countries', function (Blueprint $table) {
            $table->boolean('product_count')->default(0);
        });

        Schema::table('location_states', function (Blueprint $table) {
            $table->boolean('product_count')->default(0);
        });

        Schema::table('location_cities', function (Blueprint $table) {
            $table->boolean('product_count')->default(0);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_countries', function (Blueprint $table) {
            $table->dropColumn('product_count');
        });

        Schema::table('location_states', function (Blueprint $table) {
            $table->dropColumn('product_count');
        });

        Schema::table('location_cities', function (Blueprint $table) {
            $table->dropColumn('product_count');
        });
    }
}

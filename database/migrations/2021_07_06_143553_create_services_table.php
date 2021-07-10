<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('featured_image');
            $table->string('min_duration');
            $table->string('min_duration_unit');
            $table->string('max_duration');
            $table->string('max_duration_unit');
            $table->string('icon_image');
            $table->unsignedBigInteger('category_id');
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->unsignedFloat('service_charge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}

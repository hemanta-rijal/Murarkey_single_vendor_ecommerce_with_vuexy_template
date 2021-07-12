<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable()->unique();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->boolean('featured')->default(true);
            $table->string('icon_image');
            $table->string('banner_image');
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');
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
        Schema::dropIfExists('service_categories');
    }
}

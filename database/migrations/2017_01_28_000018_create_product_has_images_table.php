<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductHasImagesTable extends Migration
{
    /**
     * Run the migrations.
     * @table product_has_images
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('image', 300)->nullable();
            $table->string('caption', 300)->nullable();
            $table->integer('product_id')->unsigned();


            $table->foreign('product_id', 'fk_product_has_images_products1_idx')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('product_has_images');
     }
}

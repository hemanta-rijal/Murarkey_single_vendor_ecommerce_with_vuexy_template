<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductHasAttributesTable extends Migration
{
    /**
     * Run the migrations.
     * @table product_has_attributes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_attributes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('key', 45)->nullable();
            $table->string('value', 45)->nullable();
            $table->integer('product_id')->unsigned();


            $table->foreign('product_id', 'fk_product_has_attributes_products1_idx')
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
       Schema::dropIfExists('product_has_attributes');
     }
}

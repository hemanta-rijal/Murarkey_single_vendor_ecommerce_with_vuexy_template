<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductHasKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     * @table product_has_keywords
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_keywords', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45)->nullable();
            $table->integer('products_id')->unsigned();


            $table->foreign('products_id', 'fk_product_has_keywords_products1_idx')
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
       Schema::dropIfExists('product_has_keywords');
     }
}

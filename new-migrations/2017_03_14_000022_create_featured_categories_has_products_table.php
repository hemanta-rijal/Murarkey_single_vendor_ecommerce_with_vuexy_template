<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedCategoriesHasProductsTable extends Migration
{
    /**
     * Run the migrations.
     * @table featured_categories_has_products
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_categories_has_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('weight')->nullable();
            $table->integer('featured_category_id');
            $table->integer('product_id');


            $table->foreign('featured_category_id', 'fk_featured_categories_has_products_featured_categories1_idx')
                ->references('id')->on('featured_categories')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('product_id', 'fk_featured_categories_has_products_products1_idx')
                ->references('id')->on('products')
                ->onDelete('no action')
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
       Schema::dropIfExists('featured_categories_has_products');
     }
}

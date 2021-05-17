<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedCompaniesHasProductsTable extends Migration
{
    /**
     * Run the migrations.
     * @table featured_companies_has_products
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_companies_has_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('weight')->nullable();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('featured_company_id');

            $table->timestamps();


            $table->foreign('product_id', 'fk_featured_companies_has_products_products1_idx')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('featured_company_id', 'fk_featured_companies_has_products_featured_companies1_idx')
                ->references('id')->on('featured_companies')
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
       Schema::dropIfExists('featured_companies_has_products');
     }
}

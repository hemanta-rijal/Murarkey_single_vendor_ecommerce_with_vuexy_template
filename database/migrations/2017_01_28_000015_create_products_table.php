<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->string('slug', 500);
            $table->string('model_number', 100)->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('place_of_origin', 100)->nullable();
            $table->text('details')->nullable();
            $table->string('unit_type', 100)->nullable();
            $table->integer('seller_id')->unsigned();
            $table->integer('company_id')->unsigned()->nullable();
            $table->boolean('featured')->nullable()->default('0');
            $table->integer('post_by')->unsigned();
            $table->string('discount_type')->nullable();

            $table->foreign('seller_id', 'fk_products_sellers1_idx')
                ->references('id')->on('sellers')
                ->onDelete('no action')
                ->onUpdate('no action');

            // $table->foreign('company_id', 'fk_products_companies1_idx')
            //     ->references('id')->on('companies')
            //     ->onDelete('cascade')
            //     ->onUpdate('no action');

            $table->foreign('post_by', 'fk_products_users1_idx')
                ->references('id')->on('users')
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
        Schema::dropIfExists('products');
    }
}

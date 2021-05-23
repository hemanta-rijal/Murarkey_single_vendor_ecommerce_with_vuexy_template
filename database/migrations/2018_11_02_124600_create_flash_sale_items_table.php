<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlashSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_sale_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weight')->nullable();
            $table->string('discount_type');
            $table->float('discount');
            $table->float('actual_price');
            $table->float('discounted_price');
            $table->unsignedInteger('flash_sale_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();

            $table->foreign('flash_sale_id', 'fk_flash_sales_and_flash_sale_items_1_idx')
                ->references('id')->on('flash_sales')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('product_id', 'fk_flash_sale_items_products1_idx')
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
        Schema::dropIfExists('flash_sale_items');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductHasTradeInfoTable extends Migration
{
    /**
     * Run the migrations.
     * @table product_has_trade_info
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_trade_info', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->float('MOQ')->nullable();
            $table->float('Price')->nullable();
            $table->integer('product_id')->unsigned();

            $table->foreign('product_id', 'fk_product_has_trade_info_products_idx')
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
        Schema::dropIfExists('product_has_trade_info');
    }
}

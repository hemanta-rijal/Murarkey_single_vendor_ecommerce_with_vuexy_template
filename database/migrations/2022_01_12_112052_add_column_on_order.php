<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOnOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function($table) {
            $table->text('coupon_detail')->nullable();
            $table->double('coupon_discount_price',8,2)->nullable();
            $table->double('sub_total',8,2)->nullable();
            $table->double('tax',8,2)->default(0);
            $table->double('total_price',8,2)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

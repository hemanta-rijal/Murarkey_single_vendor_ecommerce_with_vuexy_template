<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProductTradeInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_has_trade_info', function (Blueprint $table) {
            $table->renameColumn('MOQ','moq');
            $table->renameColumn('Price','price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_has_trade_info', function (Blueprint $table) {
            $table->renameColumn('moq','MOQ');
            $table->renameColumn('price','Price');
        });
    }
}

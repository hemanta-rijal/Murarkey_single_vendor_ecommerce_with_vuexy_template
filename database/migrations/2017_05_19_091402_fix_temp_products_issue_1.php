<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixTempProductsIssue1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $cloningTables = [
        'products',
        'product_has_attributes',
        'product_has_images',
        'product_has_keywords',
        'product_has_trade_info'
    ];

    public function up()
    {
        foreach ($this->cloningTables as $table) {
            \DB::table('temp_' . $table)->truncate();
            \DB::statement("ALTER TABLE `temp_{$table}` MODIFY COLUMN `id` INT NOT NULL AUTO_INCREMENT");
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_products', function (Blueprint $table) {
            //
        });
    }
}

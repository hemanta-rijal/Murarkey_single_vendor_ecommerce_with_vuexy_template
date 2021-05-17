<?php

use Illuminate\Database\Migrations\Migration;

class CloneProductsTableToTempProducts extends Migration
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
        foreach ($this->cloningTables as $table)
            \DB::statement('CREATE TABLE temp_' . $table . ' SELECT * FROM ' . $table . ' LIMIT 0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->cloningTables as $table)
            Schema::dropIfExists('temp_' . $table);
    }
}

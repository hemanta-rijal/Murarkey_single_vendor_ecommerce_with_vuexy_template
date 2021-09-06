<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_name'); //american dolor
            $table->string('short_name'); // USD
            $table->string('icon'); // flag icon
            $table->string('symbol'); // $
            $table->string('rate'); // equivalency
            $table->enum('symbol_pacement', ['front', 'back']); // currency placemnt to the amount $ 100 or 50 €
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}

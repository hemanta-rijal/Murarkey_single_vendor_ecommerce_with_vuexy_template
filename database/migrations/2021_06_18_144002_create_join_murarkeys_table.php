<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinMurarkeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_murarkeys', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable('');
            $table->string('phone_number')->nullable();
            $table->string('viber_number')->nullable();
            $table->string('preferred_work')->nullable();
            $table->string('preferred_location')->nullable();
            $table->string('about');
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
        Schema::dropIfExists('join_murarkeys');
    }
}

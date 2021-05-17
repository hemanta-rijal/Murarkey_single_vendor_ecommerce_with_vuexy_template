<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     * @table pages
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('slug', 300)->nullable();
            $table->string('template', 200)->nullable();
            $table->longText('content')->nullable();
            $table->boolean('published')->nullable();
            $table->boolean('system_dependent')->nullable();
            $table->integer('weight')->nullable();

            $table->unique(["slug"], 'unique_pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}


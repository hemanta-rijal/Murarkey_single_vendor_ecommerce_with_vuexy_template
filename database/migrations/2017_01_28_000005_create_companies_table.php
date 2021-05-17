<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     * @table companies
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->string('established_year', 45)->nullable();
            $table->string('business_type', 45)->nullable();
            $table->text('products')->nullable();
            $table->string('operational_address', 255)->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('province', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('website', 300)->nullable();
            $table->string('government_business_permit', 300)->nullable();
            $table->text('description')->nullable();
            $table->string('logo', 300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('companies');
     }
}

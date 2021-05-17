<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     * @table featured_companies
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_companies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('weight')->nullable();
            $table->string('name', 200)->nullable();
            $table->integer('company_id');


            $table->foreign('company_id', 'fk_featured_companies_companies1_idx')
                ->references('id')->on('companies')
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
       Schema::dropIfExists('featured_companies');
     }
}

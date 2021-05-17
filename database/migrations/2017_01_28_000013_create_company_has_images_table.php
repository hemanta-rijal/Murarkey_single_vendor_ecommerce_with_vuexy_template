<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyHasImagesTable extends Migration
{
    /**
     * Run the migrations.
     * @table company_has_images
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_has_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type', 45)->nullable();
            $table->string('image', 300)->nullable();
            $table->string('position_top', 45)->nullable();
            $table->string('position_bottom', 45)->nullable();
            $table->string('position_left', 45)->nullable();
            $table->string('position_right', 45)->nullable();
            $table->integer('company_id')->unsigned();


            $table->foreign('company_id', 'fk_company_has_images_companies1_idx')
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
       Schema::dropIfExists('company_has_images');
     }
}

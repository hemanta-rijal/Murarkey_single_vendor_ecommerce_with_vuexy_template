<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     * @table sellers
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('position', 45)->nullable();
            $table->text('mobile_number')->nullable();
            $table->text('landline_number')->nullable();
            $table->text('fax')->nullable();
            $table->string('skype', 45)->nullable();
            $table->string('wechat', 45)->nullable();
            $table->string('viber', 45)->nullable();
            $table->string('whatsapp', 45)->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();


            $table->foreign('user_id', 'fk_sellers_users1_idx')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('company_id', 'fk_sellers_companies1_idx')
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
       Schema::dropIfExists('sellers');
     }
}

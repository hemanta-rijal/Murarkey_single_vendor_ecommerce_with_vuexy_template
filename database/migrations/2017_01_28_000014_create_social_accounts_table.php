<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     * @table social_accounts
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('provider', 45)->nullable();
            $table->string('provider_user_id', 45)->nullable();
            $table->text('response_data')->nullable();
            $table->integer('user_id')->unsigned();


            $table->foreign('user_id', 'fk_social_accounts_users1_idx')
                ->references('id')->on('users')
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
       Schema::dropIfExists('social_accounts');
     }
}

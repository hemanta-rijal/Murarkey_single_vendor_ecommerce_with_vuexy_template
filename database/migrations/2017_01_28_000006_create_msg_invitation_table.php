<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgInvitationTable extends Migration
{
    /**
     * Run the migrations.
     * @table msg_invitation
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msg_invitation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('from')->unsigned()->nullable();
            $table->integer('to')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('status', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('msg_invitation');
     }
}

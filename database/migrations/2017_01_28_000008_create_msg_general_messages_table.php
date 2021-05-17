<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgGeneralMessagesTable extends Migration
{
    /**
     * Run the migrations.
     * @table msg_general_messages
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msg_general_messages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('from')->unsigned()->nullable();
            $table->integer('to')->unsigned()->nullable();
            $table->text('text')->nullable();
            $table->text('attachment')->nullable();
            $table->string('status', 45)->nullable();
            $table->timestamp('last_poll_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('msg_general_messages');
     }
}

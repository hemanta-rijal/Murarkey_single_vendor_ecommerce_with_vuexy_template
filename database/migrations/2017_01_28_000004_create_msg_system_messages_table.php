<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgSystemMessagesTable extends Migration
{
    /**
     * Run the migrations.
     * @table msg_system_messages
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msg_system_messages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('from')->unsigned()->nullable();
            $table->string('for_role', 45)->nullable();
            $table->text('text')->nullable();
            $table->string('status', 45)->nullable();
            $table->string('type', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('msg_system_messages');
     }
}

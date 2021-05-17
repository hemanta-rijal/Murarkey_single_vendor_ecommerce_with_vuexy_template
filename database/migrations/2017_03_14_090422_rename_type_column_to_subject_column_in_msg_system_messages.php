<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTypeColumnToSubjectColumnInMsgSystemMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msg_system_messages', function (Blueprint $table) {
            $table->renameColumn('type', 'subject');
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
        Schema::table('msg_system_messages', function (Blueprint $table) {
            $table->renameColumn('subject', 'type');
            $table->dropTimestamps();
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteReasonOnUsersSellersCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('delete_reason')->nullable();
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->text('delete_reason')->nullable();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->text('delete_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('delete_reason');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('delete_reason');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('delete_reason');
        });

    }
}

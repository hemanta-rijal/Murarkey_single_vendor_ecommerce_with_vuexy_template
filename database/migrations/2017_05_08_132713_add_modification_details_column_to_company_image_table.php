<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModificationDetailsColumnToCompanyImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_has_images', function (Blueprint $table) {
            $table->string('modification_details', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_has_images', function (Blueprint $table) {
            $table->dropColumn('modification_details');
        });
    }
}

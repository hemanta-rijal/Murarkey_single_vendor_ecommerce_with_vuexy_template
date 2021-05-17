<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCompanyHasImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_has_images', function (Blueprint $table) {

            $table->dropColumn('position_top');
            $table->dropColumn('position_bottom');
            $table->dropColumn('position_left');
            $table->dropColumn('position_right');

            $table->string('position_x', 10)->default('0px');
            $table->string('position_y', 10)->default('0px');
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
            $table->string('position_top', 45)->nullable();
            $table->string('position_bottom', 45)->nullable();
            $table->string('position_left', 45)->nullable();
            $table->string('position_right', 45)->nullable();

            $table->dropColumn('position_x');

            $table->dropColumn('position_y');
        });
    }
}

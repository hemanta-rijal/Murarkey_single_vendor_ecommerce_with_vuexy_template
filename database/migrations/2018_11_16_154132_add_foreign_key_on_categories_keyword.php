<?php

use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOnCategoriesKeyword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('ALTER TABLE category_keywords
ADD CONSTRAINT category_keywords_categories_id_fk
FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

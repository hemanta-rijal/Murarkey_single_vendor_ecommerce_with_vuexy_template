<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'order_item';

    /**
     * Run the migrations.
     * @table order_item
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->integer('qty')->nullable();
            $table->float('price')->nullable();
            $table->text('options')->nullable();
            $table->integer('order_id')->unsigned();

            $table->index(["order_id"], 'order_item_orders_id_fk');
            $table->nullableTimestamps();


            $table->foreign('order_id', 'order_item_orders_id_fk')
                ->references('id')->on('orders')
                ->onDelete('no action')
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
       Schema::dropIfExists($this->set_schema_table);
     }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderShareItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_share_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_share_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('share_amount');
            $table->unsignedInteger('share_unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_share_items');
    }
}

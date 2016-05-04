<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('share_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('amount');
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['share_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('share_items');
    }
}

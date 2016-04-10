<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->unsignedInteger('price_value')->nullable();
            $table->unsignedInteger('price_amount')->nullable();
            $table->string('price_unit')->nullable();
            $table->unsignedInteger('step_amount')->nullable();
            $table->string('step_unit')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_prices');
    }
}

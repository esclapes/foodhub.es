<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('origin')->nullable();
            $table->string('category')->nullable();
            $table->integer('group_id')->unsigned();
            $table->unsignedInteger('price_value')->nullable();
            $table->unsignedInteger('price_amount')->nullable();
            $table->string('price_unit')->nullable();
            $table->unsignedInteger('step_amount')->nullable();
            $table->string('step_unit')->nullable();
            $table->softDeletes();
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
        Schema::drop('products');
    }
}

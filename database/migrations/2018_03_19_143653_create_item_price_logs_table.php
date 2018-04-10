<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPriceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_price_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->string('price');
            $table->string('price_discount')->nullable();
            $table->float('discount')->nullable();
            $table->boolean('pivot')->default(1);
            $table->string('condition')->nullable();
            $table->timestamps();

            $table->foreign('item_id')
                 ->references('id')->on('items')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_price_logs');
    }
}

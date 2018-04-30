<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->string('price_now');
            $table->string('price_discount_now')->nullable();
            $table->string('discount_now')->nullable();
            $table->string('price_prev');
            $table->string('price_discount_prev')->nullable();
            $table->string('discount_prev')->nullable();
            $table->string('price_status');
            $table->string('price_discount_status')->nullable();
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
        Schema::dropIfExists('price_changes');
    }
}

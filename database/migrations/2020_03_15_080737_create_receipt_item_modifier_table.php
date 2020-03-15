<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptItemModifierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_item_modifier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('receipt_item_id');
            $table->unsignedBigInteger('item_modifier_id');
            $table->integer('quantity');
            $table->foreign('receipt_item_id')->on('receipt_item')->references('id')
                ->onUpdate('cascade');
            $table->foreign('item_modifier_id')->on('item_modifier')->references('id')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('receipt_item_modifier');
    }
}

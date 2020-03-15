<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_set', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('set_id');
            $table->unsignedBigInteger('receipt_id');
            $table->integer('quantity');
            $table->foreign('set_id')->on('sets')->references('id')
                ->onUpdate('cascade');
            $table->foreign('receipt_id')->on('receipts')->references('id')
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
        Schema::dropIfExists('receipt_sets');
    }
}

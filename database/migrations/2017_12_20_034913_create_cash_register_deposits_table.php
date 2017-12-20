<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashRegisterDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_register_deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank')->nulllable();
            $table->string('account')->nullable();
            $table->date('date');
            $table->string('baucher');
            $table->decimal('amount', 10, 2);
            $table->unsignedInteger('cash_register_id');
            $table->foreign('cash_register_id')->references('id')->on('cash_registers')->onDelete('cascade');
            $table->softdeletes();
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
        Schema::dropIfExists('cash_register_deposits');
    }
}

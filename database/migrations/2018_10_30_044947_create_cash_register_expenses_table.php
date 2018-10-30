<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashRegisterExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_register_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cash_register_id');
            $table->foreign('cash_register_id')->references('id')->on('cash_registers');
            $table->decimal('amount', 10, 2);
            $table->mediumText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_register_expenses');
    }
}

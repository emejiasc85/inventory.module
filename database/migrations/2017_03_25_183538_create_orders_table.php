<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', [
                'Creado',
                'Solicitado',
                //'Confirmado',
                'Ingresado',
                'Cancelado'
            ])->default('Creado');
            $table->enum('priority', [
                'Alta',
                'Media',
                'Baja',
            ])->default('Baja');
            $table->date('delivery')->nullable();
            $table->float('total')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedInteger('people_id');
            $table->foreign('people_id')
                ->references('id')
                ->on('people')
                ->onDelete('cascade');
            $table->unsignedInteger('order_type_id');
            $table->foreign('order_type_id')
                ->references('id')
                ->on('order_types')
                ->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}

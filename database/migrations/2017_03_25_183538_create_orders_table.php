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
                'Confirmado',
                'Entregado',
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
                $table->unsignedInteger('provider_id');
            $table->foreign('provider_id')
                ->references('id')
                ->on('users')
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

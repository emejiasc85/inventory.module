<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('patent_name')->nullable();
            $table->string('patent')->nullable();
            $table->mediumtext('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('other_phone')->nullable();
            $table->string('nit')->nullable();
            $table->float('tax')->nullable();
            $table->float('profit')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('commerces');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from');
            $table->string('serie');
            $table->string('resolution')->unique()->index();
            $table->integer('to');
            $table->date('date');
            $table->boolean('status')->default(true);
            $table->unsignedInteger('commerce_id');
            $table->foreign('commerce_id')->references('id')->on('commerces');
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
        Schema::dropIfExists('resolutions');
    }
}

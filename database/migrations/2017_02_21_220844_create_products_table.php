<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug')->index();
            $table->string('full_name')->nullable()->index();
            $table->mediumtext('description')->nullable();
            $table->string('barcode')->nullable();
            $table->float('minimum_stock')->nullable();
            $table->unsignedInteger('make_id');
            $table->unsignedInteger('product_presentation_id');
            $table->unsignedInteger('product_group_id');
            $table->unsignedInteger('unit_measure_id');
            $table->foreign('make_id')->references('id')->on('makes');
            $table->foreign('product_group_id')->references('id')->on('product_groups');
            $table->foreign('product_presentation_id')->references('id')->on('product_presentations');
            $table->foreign('unit_measure_id')->references('id')->on('unit_measures');
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
        Schema::dropIfExists('products');
    }
}

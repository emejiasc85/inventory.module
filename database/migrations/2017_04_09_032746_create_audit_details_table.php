<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('audit_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('audit_id');
            $table->unsignedInteger('product_id');
            $table->integer('current_stock');
            $table->integer('audited_stock');
            $table->foreign('audit_id')->references('id')->on('audits')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->enum('status', [
                'ok',
                'bad',
            ])->default('bad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('audit_details');
    }
}

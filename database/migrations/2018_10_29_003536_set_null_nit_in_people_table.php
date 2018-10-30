<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullNitInPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function(Blueprint $table)
        {
            DB::statement('ALTER TABLE people MODIFY nit VARCHAR(200) null');
        });
    }

    public function down()
    {
        Schema::table('people', function(Blueprint $table)
        {
            DB::statement('ALTER TABLE people MODIFY nit VARCHAR(200) null');
        });
    }
}

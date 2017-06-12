<?php

use EmejiasInventory\Entities\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'captus']);
        Tag::create(['name' => 'elefante']);
    }
}

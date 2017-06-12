<?php

use EmejiasInventory\Entities\Color;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('helpers.colors') as $key => $value) {
            Color::create(['color' => $key]);
        }
    }
}

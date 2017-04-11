<?php

use EmejiasInventory\Entities\People;
use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        People::create([
            'nit' => '61580635',
            'name' => 'Enrique Mejias',
            'address' => 'San benito',
            'type' => 'provider'
        ]);

        People::create([
            'nit' => '61580637',
            'name' => 'Antony OJ',
            'address' => 'San benito',
            'type' => 'provider'
        ]);
    }
}

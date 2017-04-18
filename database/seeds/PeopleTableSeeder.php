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
            'id'    => 1,
            'nit' => 'CF',
            'name' => 'Consumidor Final',
            'address' => 'Ciudad',
            'type' => 'customer'
        ]);
        People::create([
            'id'    => 2,
            'nit' => '61580635',
            'name' => 'Enrique Mejias',
            'address' => 'San benito',
            'type' => 'provider'
        ]);
        People::create([
            'id'    => 3,
            'nit' => '61580637',
            'name' => 'Antony OJ',
            'address' => 'San benito',
            'type' => 'provider'
        ]);
    }
}

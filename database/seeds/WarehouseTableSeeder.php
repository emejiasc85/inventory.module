<?php

use EmejiasInventory\Entities\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'id' => 1,
            'commerce_id' => 1,
            'name' => 'Inventario',
        ]);
    }
}

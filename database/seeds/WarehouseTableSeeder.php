<?php

use EmejiasInventory\Entities\Warehouse;
use Illuminate\Database\Seeder;

<<<<<<< HEAD
class WarehouseTableSeeder extends Seeder {
=======
class WarehouseTableSeeder extends Seeder
{
>>>>>>> refs/remotes/origin/master
    /**
     * Run the database seeds.
     *
     * @return void
     */
<<<<<<< HEAD
    public function run() {
        Warehouse::create([
            'id' => 1,
            'name' => 'Inventario',
=======
    public function run()
    {
        Warehouse::create([
            'id' => 1,
            'name' => 'Inventario'
>>>>>>> refs/remotes/origin/master
        ]);
    }
}

<?php

use EmejiasInventory\Entities\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => 1,
            'name' => 'Administrador'
        ]);
        Role::create([
            'id' => 2,
            'name' => 'Gerencia'
        ]);
        Role::create([
            'id' => 3,
            'name' => 'operador'
        ]);
    }
}

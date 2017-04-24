<?php

use EmejiasInventory\Entities\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     * preuba de git
     * @return void
     */
    public function run() {
        factory(User::class)->create([
            'name' => 'Enrique Mejias',
            'username' => 'emejias',
            'email' => 'emejiasc85@gmail.com',
            'role_id'  => 1
        ]);
        factory(User::class)->create([
            'name' => 'Antony',
            'username' => 'laga',
            'email' => 'laga1254@gmail.com',
            'role_id'  => 1
        ]);
    }
}

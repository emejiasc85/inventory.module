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
            'email' => 'emejiasc85@gmail.com',
        ]);
        factory(User::class)->create([
            'name' => 'Antony',
            'email' => 'laga1254@gmail.com',
        ]);
    }
}

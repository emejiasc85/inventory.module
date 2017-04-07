<?php

use EmejiasInventory\Entities\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(User::class)->create([
            'name' => 'emejias',
            'email' => 'emejiasc85@gmail.com',
        ], [
            'name' => 'Tonkry',
            'email' => 'laga1254@gmail.com',
        ]);
    }
}

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
        User::create([
            'name'     => 'administrador',
            'username' => 'admin',
            'email'    => 'admin@admin.com',
            'role_id'  => 1
        ]);


        User::create([
            'name'     => 'Enrique Mejias',
            'username' => 'emejias',
            'email'    => 'emejiasc85@gmail.com',
            'role_id'  => 1
        ]);

        foreach (User::all() as $user) {
            $user->api_token = str_random(100);
            $user->save();
        }
    }
}

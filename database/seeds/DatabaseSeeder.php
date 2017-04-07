<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CommerceTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(OrderTypeTableSeeder::class);
    }
}

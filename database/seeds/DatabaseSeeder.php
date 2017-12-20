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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CommerceTableSeeder::class);
        $this->call(OrderTypeTableSeeder::class);
        $this->call(WarehouseTableSeeder::class);
        $this->call(ColorTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        //$this->call(TagTableSeeder::class);
    }
}

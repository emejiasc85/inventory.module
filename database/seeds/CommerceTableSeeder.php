<?php

use EmejiasInventory\Entities\Commerce;
use Illuminate\Database\Seeder;

class CommerceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$name = 'Centro Medico Maya';
        Commerce::create([
        	'name' => $name,
	    	'patent_name' => $name,
	    	'address' => 'Santa Elena',
	    	'phone' =>  '79261212',
	    	'tax' => 3,
	    	'profit' => 10,
        ]);
    }
}

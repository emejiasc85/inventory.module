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
    	$name = 'Generico';
        Commerce::create([
            'id' => 1,
        	'name' => $name,
	    	'patent_name' => $name,
	    	'address' => 'N/A',
	    	'phone' =>  'N/A',
	    	'tax' => 3,
	    	'profit' => 10,
        ]);
    }
}

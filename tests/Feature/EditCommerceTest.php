<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Commerce;
use Tests\FeatureTestCase;

class EditCommerceTest extends FeatureTestCase
{

    public function test_a_user_can_edit_a_commerce()
    {
    	//having
    	$name    = 'Farmacia Maya';
    	$address = 'Santa Elena';
    	$phone	 = '79261212';
    	$nit	 = '6158063-5';
    	$iva	 = 2;
    	$profit  =  20;

        $user = $this->defaultUser();
        $commerce = factory(Commerce::class)->create();
        //when
        $this->actingAs($user)
        	->visit($commerce->url)
        	->see($commerce->name)
        	->type($name, 'name')
        	->type($name, 'patent_name')
        	->type($address, 'address')
        	->type($nit, 'nit')
        	->type($phone, 'phone')
        	->type($iva, 'tax')
        	->type($profit, 'profit')
        	->press('Guardar');

        $this->seeInDatabase('commerces', [
        	'name' 			=> $name,
        	'patent_name' 	=> $name,
        	'address' 		=> $address,
        	'nit' 			=> $nit,
        	'tax' 			=> $iva,
        	'phone' 		=> $phone,
        	'profit' 		=> $profit
        ]);

        $this->see('Se realizaron los cambios correctamente');

    }
}

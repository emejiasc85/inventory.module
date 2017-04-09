<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Commerce;
use Tests\FeatureTestCase;

class EditCommerceTest extends FeatureTestCase
{

   	function test_a_user_can_edit_a_commerce()
    {
    	//having
    	$name    = 'Farmacia Maya';
    	$address = 'Santa Elena';
    	$phone  = '79261212';
    	$nit	 = '61580635';
    	$iva	 = 2;
    	$profit  =  20;

        $user = $this->defaultUser();
        $commerce = factory(Commerce::class)->create();
        //when
        $this->actingAs($user)
        	->visit($commerce->editUrl)
        	->see($commerce->name)
        	->type($name, 'name')
        	->type($name, 'patent_name')
        	->type($address, 'address')
        	->type($nit, 'nit')
            ->type($phone, 'phone')
        	->type('', 'other_phone')
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

    function test_validate_form_on_edit_commerce()
    {
    	//having
    	$user = $this->defaultUser();
        $commerce = factory(Commerce::class)->create();
        //when
        $this->actingAs($user)
        	->visit($commerce->editUrl)
        	->see($commerce->name)
        	->type('', 'name')
        	->type('', 'patent_name')
        	->type('', 'address')
        	->type('', 'nit')
        	->type('', 'phone')
        	->type('', 'tax')
        	->type('', 'profit')
        	->press('Guardar');
        //then
        $this->seeErrors([
        	'name'		=> 'El campo nombre es obligatorio',
        	'address'	=> 'El campo dirección es obligatorio',
        	'phone'		=> 'El campo teléfono es obligatorio',
        ]);
    }
}

<?php

namespace Tests\Feature;

use Tests\FeatureTestCase;


class CreateCommerceTest extends FeatureTestCase
{

    function test_a_user_can_create_a_commerce()
    {
    	//having
        $name    = 'Farmacia Maya';
        $address = 'Santa Elena';
        $phone   = '79261212';
        $nit     = '61580635';
        $iva     = 2;
        $profit  =  20;
        $user    = $this->defaultUser();
        //when
        $this->actingAs($user)
        	->visit(route('commerces.create'))
        	->type($name, 'name')
        	->type($name, 'patent_name')
        	->type($address, 'address')
        	->type($nit, 'nit')
            ->type($phone, 'phone')
        	->type('', 'other_phone')
        	->type($iva, 'tax')
        	->type($profit, 'profit')
        	->press('Guardar');
        //then

         $this->seeInDatabase('commerces', [
        	'name' 			=> $name,
        	'patent_name' 	=> $name,
        	'address' 		=> $address,
        	'nit' 			=> $nit,
        	'tax' 			=> $iva,
        	'phone' 		=> $phone,
        	'profit' 		=> $profit
        ]);

        $this->see('Comercio creado correctamente.');


    }
}

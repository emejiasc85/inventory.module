<?php

namespace tests\Feature;

use Tests\FeatureTestCase;


class CreateMakesTest extends FeatureTestCase
{
   function test_a_user_can_create_a_make()
    {
        //having
        $user = $this->defaultUser();

        //when
        $this->actingAs($user)
      		->visit(route('makes.create'))
      		->see('Marcas')
      		->type('Bayer', 'name')
      		->press('Guardar');

      	//then
      	$this->seeInDatabase('makes', [
      		'name' => 'Bayer'
      	]);

      	$this->see('Marca agregada correctamente');
    }


    function test_validate_form_on_create_a_make()
    {
    	 //having
        $user = $this->defaultUser();

        //when
        $this->actingAs($user)
      		->visit(route('makes.create'))
      		->see('Marcas')
      		->press('Guardar');

      	//then
      	$this->seeErrors([
      		'name' => 'El campo nombre es obligatorio'
      	]);

    }
}

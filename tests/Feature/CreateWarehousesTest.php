<?php

namespace Tests\Feature;

use Tests\FeatureTestCase;


class CreateWarehousesTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    function test_a_user_can_create_a_warehouse()
    {
    	//having
    	$fields = [
    		'name' => 'bodega 1',
    		'description' => 'bodega principal',
    	];

    	//when
    	$this->actingAs($this->defaultUser())
    	->visit(route('warehouses.create'))
    	->see('Bodega')
    	->form($fields);

        //then
    	$this->press('Guardar');
    	$this->seeInDatabase('warehouses', $fields);
        $this->see('Bodega agregada correctamente');
    }

    function test_validate_form()
    {

        //when
        $this->actingAs($this->defaultUser())
            ->visit(route('warehouses.create'))
            ->press('Guardar');

         //then
        $this->seeErrors([
            'name' => 'El campo nombre es obligatorio'
        ]);
    }
}

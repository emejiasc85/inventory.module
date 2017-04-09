<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Commerce;
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
        $commerce = factory(Commerce::class)->create();
    	//having
    	$fields = [
    		'name' => 'bodega 1',
    		'description' => 'bodega principal',
            'commerce_id' => $commerce->id
    	];

    	//when
    	$this->actingAs($this->defaultUser())
    	->visit(route('warehouses.create'))
    	->see('Bodega')
    	->form($fields);
    	$this->press('Guardar');

        //then
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
            'name'        => 'El campo nombre es obligatorio',
            'commerce_id' => 'El campo comercio es obligatorio'
        ]);
    }
}

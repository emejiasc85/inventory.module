<?php

namespace Tests\Feature;

use Tests\FeatureTestCase;

class CreateOrderTypesTest extends FeatureTestCase
{
    function test_user_can_create_order_types()
    {
        //having
        $fields = [
        	'name' => 'Pedidos',
        	'description' => 'Ordenes'
        ];
        $this->actingAs($this->defaultUser());
        //when
        $this->visit(route('orders.type.create'))
        	->see('Tipo de Orden')
        	->form($fields);
        $this->press('Guardar');
        //then
        $this->seeInDatabase('order_types', $fields);
        $this->see('Tipo de orden creada correctamente');
    }

    function test_validate_form()
    {
        //when
        $this->actingAs($this->defaultUser())
            ->visit(route('orders.type.create'))
            ->press('Guardar');

         //then
        $this->seeErrors([
            'name' => 'El campo nombre es obligatorio'
        ]);
    }
}

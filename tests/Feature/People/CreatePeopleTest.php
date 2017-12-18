<?php

namespace Tests\Feature\People;

use Tests\FeatureTestCase;


class CreatePeopleTest extends FeatureTestCase
{

    function test_user_can_create_people()
    {
        //having
        $this->actingAs($this->defaultUser());
        $fields = [
            'nit'        => '6158063-5',
            'name'       => 'Enrique Mejias',
            'address'    => 'San benito',
            'phone'      => '54606633',
            'email'      => 'emejiasc85@gmail.com',
            'type'       => 'provider',
            'partner'    => true,
            'max_credit' => 5000
        ];

        //when
        $this->visit(route('people.create'))
            ->form($fields);
        $this->press('Guardar');
        //then
        $this->seeInDatabase('people', $fields);
    }


    function test_form_validate()
    {
        //having
        $this->actingAs($this->defaultUser());
         //when
        $this->visit(route('people.create'))
            ->press('Guardar');
        //then
        $this->seeErrors([
            'nit'     => 'El campo nit es obligatorio',
            'name'    => 'El campo nombre es obligatorio',
            'address' => 'El Campo dirección es obligatorio',
        ]);
    }
}

<?php

namespace Tests\Feature\People;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePeopleTest extends TestCase
{
    use RefreshDatabase;

    function test_it_create_people()
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

        $this->from(route('people.create'))
            ->post(route('people.store'), $fields);
        //then
        $this->assertDatabaseHas('people', $fields);
    }


    function test_form_validate()
    {
        //having
        $this->actingAs($this->defaultUser());
         //when
        $this->post(route('people.store'), []);
        //then
        $this->assertArrayHasKey([
            'errors' => [
                'nit'     => 'El campo nit es obligatorio',
                'name'    => 'El campo nombre es obligatorio',
                'address' => 'El Campo dirección es obligatorio',
            ]
        ]);


    }
}

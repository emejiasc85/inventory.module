<?php

namespace tests\Feature\People;

use EmejiasInventory\Entities\People;
use Tests\FeatureTestCase;

class ListPeopleTest extends FeatureTestCase
{
    function test_user_can_see_people_list()
    {
        //having
        $this->actingAs($this->defaultUser());
        $people = factory(People::class)->create([
            'nit'        => '6158063-5',
            'name'       => 'Enrique Mejias',
            'address'    => 'San benito',
            'phone'      => '54606633',
            'email'      => 'emejiasc85@gmail.com',
            'type'       => 'provider',
            'partner'    => true,
            'max_credit' => 5000,
        ]);
        //when
        $this->visit(route('people.index'));
        //then
        $this->see('Personas')
            ->seeInElement('td', $people->name)
            ->seeInElement('td', $people->nit)
            ->seeInElement('td', $people->address)
            ->seeInElement('td', $people->email)
            ->seeInElement('td', $people->phone)
            ->seeInElement('td', 'Proveedor')
            ->seeInElement('td', 5000);
    }

    function test_a_user_can_paginate_people()
    {
        //having
        $first_people = factory(People::class)->create(['name' => 'Enrique']);
        $people = factory(People::class)->times(15)->create();
        $last_people = factory(People::class)->create(['name' => 'Antony']);

        $this->actingAs($this->defaultUser())
        ->visit(route('people.index'))
        ->see('Personas')
        ->seeInElement('td', $last_people->name)
        ->dontSeeInElement('td', $first_people->name)
        ->click('2')
        ->seeInElement('td', $first_people->name)
        ->dontSeeInElement('td', $last_people->name);
    }

    function test_a_user_can_search_a_people()
    {
        //having
        $first_people = factory(People::class)->create(['name' => 'Enrique']);
        $people = factory(People::class)->times(15)->create();
        $last_people = factory(People::class)->create(['name' => 'Antony']);

        $this->actingAs($this->defaultUser())
        ->visit(route('people.index'))
        ->see('Personas')
        ->type('enr', 'name')
        ->press('Buscar')
        ->seeInElement('td', $first_people->name);

    }
}

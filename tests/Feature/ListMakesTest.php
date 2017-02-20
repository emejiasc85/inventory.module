<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Make;
use Tests\FeatureTestCase;


class ListMakesTest extends FeatureTestCase
{
    function test_a_user_can_see_makes_list()
    {
        //having
        $make = factory(Make::class)->create();

        $this->actingAs($this->defaultUser())
        ->visit(route('makes.index'))
        ->see('Marcas')
        ->seeInElement('td', $make->name);
    }

    function test_a_user_can_paginate_makes()
    {
    	//having
        $first_make = factory(Make::class)->create(['name' => 'ISR']);
        $makes = factory(Make::class)->times(15)->create();
        $last_make = factory(Make::class)->create(['name' => 'Incaparina']);

        $this->actingAs($this->defaultUser())
        ->visit(route('makes.index'))
        ->see('Marcas')
        ->seeInElement('td', $last_make->name)
        ->dontSeeInElement('td', $first_make->name)
        ->click('2')
        ->seeInElement('td', $first_make->name)
        ->dontSeeInElement('td', $last_make->name);
    }

    function test_a_user_can_search_a_make()
    {
    	//having
        $first_make = factory(Make::class)->create(['name' => 'ISR']);
        $makes = factory(Make::class)->times(15)->create();
        $last_make = factory(Make::class)->create(['name' => 'Incaparina']);

        $this->actingAs($this->defaultUser())
        ->visit(route('makes.index'))
        ->see('Marcas')
        ->type('ISR', 'name')
        ->press('Buscar')
        ->seeInElement('td', $first_make->name);

    }
}

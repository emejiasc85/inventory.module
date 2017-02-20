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
}

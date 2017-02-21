<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\UnitMeasure;
use Tests\FeatureTestCase;


class ListUnitMeasuresTest extends FeatureTestCase
{
    function test_a_user_can_see_unit_measures_list()
    {
        //having
        $unit = factory(UnitMeasure::class)->create();

        $this->actingAs($this->defaultUser())
        ->visit(route('unit.measures.index'))
        ->see('Unidades de Medida')
        ->seeInElement('td', $unit->name);
    }

    function test_a_user_can_paginate_unit_measures()
    {
    	//having
        $first_unit = factory(UnitMeasure::class)->create(['name' => 'litro']);
        $units = factory(UnitMeasure::class)->times(15)->create();
        $last_unit = factory(UnitMeasure::class)->create(['name' => 'Kilo']);

        $this->actingAs($this->defaultUser())
        ->visit(route('unit.measures.index'))
        ->see('Unidades de Medida')
        ->seeInElement('td', $last_unit->name)
        ->dontSeeInElement('td', $first_unit->name)
        ->click('2')
        ->seeInElement('td', $first_unit->name)
        ->dontSeeInElement('td', $last_unit->name);
    }

    function test_a_user_can_search_a_unit_measures()
    {
    	//having
        $first_unit = factory(UnitMeasure::class)->create(['name' => 'litro']);
        $units = factory(UnitMeasure::class)->times(15)->create();
        $last_unit = factory(UnitMeasure::class)->create(['name' => 'Kilo']);

        $this->actingAs($this->defaultUser())
        ->visit(route('unit.measures.index'))
        ->see('Unidades de Medida')
        ->type('litro', 'name')
        ->press('Buscar')
        ->seeInElement('td', $first_unit->name);

    }
}

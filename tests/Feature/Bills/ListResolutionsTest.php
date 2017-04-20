<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Resolution;
use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;

class ListResolutionsTest extends FeatureTestCase
{
    function test_a_user_can_list_a_resolutions()
    {
        //having
        Artisan::call('db:seed', ['--class' => 'CommerceTableSeeder']);
        $resolution = factory(Resolution::class)->create([
            'serie' => 'A',
            'from' => 1,
            'to' => 1000,
            'resolution' => '2015-5-247540' ,
            'date' => '2017-01-01',
            'commerce_id' => 1
        ]);
        //then
        $this->actingAs($this->defaultUser())
            ->visit(route('resolutions.index'))
            ->see('Resoluciones')
            ->seeInElement('td', $resolution->commerce->name)
            ->seeInElement('td', $resolution->resolution)
            ->seeInElement('td', $resolution->serie)
            ->seeInElement('td', $resolution->date->format('d-m-Y'))
            ->seeInElement('td', $resolution->from)
            ->seeInElement('td', $resolution->to);
    }

     function test_a_user_can_paginate_resolutions()
    {
        //having
        $first = factory(Resolution::class)->create(['resolution' => '2010-1-42-30823']);
        $groups = factory(Resolution::class)->times(15)->create();
        $last = factory(Resolution::class)->create(['resolution' => '2010-1-42-30824']);

        $this->actingAs($this->defaultUser())
        ->visit(route('resolutions.index'))
        ->seeInElement('td', $last->resolution)
        ->dontSeeInElement('td', $first->resolution)
        ->click('2')
        ->seeInElement('td', $first->resolution)
        ->dontSeeInElement('td', $last->resolution);
    }
}

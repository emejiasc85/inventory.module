<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EmejiasInventory\Entities\People;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    function test_lists_people()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $people = factory(People::class)->create();

        $this->get('api/customers')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $people->id,
                    ]
                ]
            ]);
    }

    function test_search_people()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $people = factory(People::class)->create();
        $people2 = factory(People::class)->create(['nit' => 'cf']);
        $params = [
            'nit' => 'cf'
        ];
        $this->call('GET', 'api/customers', $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $people2->id,
                    ]
                ]
            ]);
    }

    function test_create_a_people()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');

        $parameters = [
            'nit' => '6158063-5',
            'name' => 'Enrique Mejias',
            'address' => 'San Benito'
        ];

        $this->postJson('api/customers', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'nit' => '6158063-5',
                    'name' => 'Enrique Mejias',
                    'address' => 'San Benito'
                ]
            ]);

        $this->assertDatabaseHas('people', [
            'nit' => '6158063-5',
                    'name' => 'Enrique Mejias',
                    'address' => 'San Benito'
        ]);
    }
}

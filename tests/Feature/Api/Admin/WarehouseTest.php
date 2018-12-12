<?php

namespace Tests\Feature\Api\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EmejiasInventory\Entities\Warehouse;

class WarehouseTest extends TestCase
{
    use RefreshDatabase;

    function test_list_warehouses()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $warehouse = factory(Warehouse::class)->create();

        $this->get('api/admin/warehouses')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $warehouse->id,
                    ]
                ]
            ]);
    }

    public function test_store_warehouse()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $warehouse = factory(Warehouse::class)->make();
        $params = [
            'name'        => $warehouse->name,
            'description' => $warehouse->description,
            'commerce_id' => $warehouse->commerce_id

        ];

        $this->postJson('/api/admin/warehouses', $params)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $warehouse->name
                ]
            ]);
        $this->assertDatabaseHas('warehouses', $params);
    }

    public function test_validate_warehouse()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $params = [];

        $this->postJson('/api/admin/warehouses', $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.'],
                    'commerce_id' => ['El campo comercio es obligatorio.'],
                ]
            ]);
    }

    public function test_validate_unique_warehouse()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $warehouse = factory(Warehouse::class)->create();
        $params = [
            'name' => $warehouse->name,
        ];

        $this->postJson('/api/admin/warehouses', $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'  => ['nombre ya ha sido registrado.'],
                ]
            ]);
    }

    public function test_update_warehouse()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $warehouse = factory(Warehouse::class)->create();
        $data = factory(Warehouse::class)->make();
        $params = [
            'name'        => $data->name,
            'description' => $data->description,
            'commerce_id' => $data->commerce_id
        ];

        $this->putJson('/api/admin/warehouses/'.$warehouse->id, $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);
        $this->assertDatabaseHas('warehouses', $params);
    }

    public function test_validate_update_warehouse()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $warehouse = factory(Warehouse::class)->create();
        $params = [];

        $this->putJson('/api/admin/warehouses/'.$warehouse->id, $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'        => ['El campo nombre es obligatorio.'],
                    'commerce_id' => ['El campo comercio es obligatorio.'],
                ]
            ]);
    }

    public function test_validate_unique_update_warehouse()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $warehouse = factory(Warehouse::class)->create();
        $warehouse2 = factory(Warehouse::class)->create();
        $params = [
            'name' => $warehouse->name,
        ];

        $this->putJson('/api/admin/warehouses/'.$warehouse2->id, $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'  => ['nombre ya ha sido registrado.'],
                ]
            ]);
    }
}

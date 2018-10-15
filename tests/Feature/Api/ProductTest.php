<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EmejiasInventory\Entities\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    function test_list_products()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->create();

        $this->get('api/products')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $product->id,
                    ]
                ]
            ]);
    }

    function test_search_by_barcode_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'barcode' => $product->barcode,
        ];

        $this->call('GET', 'api/products', $params )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $product->id,
                    ]
                ]
            ]);
    }
    function test_search_by_name_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'name' => $product->name,
        ];

        $this->call('GET', 'api/products', $params )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $product->id,
                    ]
                ]
            ]);
    }
    function test_search_by_id_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'id' => $product->id,
        ];

        $this->call('GET', 'api/products', $params )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $product->id,
                    ]
                ]
            ]);
    }
}

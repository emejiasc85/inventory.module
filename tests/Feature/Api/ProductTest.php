<?php

namespace tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Entities\OrderType;
use EmejiasInventory\Entities\People;
use EmejiasInventory\Entities\Warehouse;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;

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
    function test_search_by_serie_id_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'product_serie_id' => $product->product_serie_id,
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
    function test_search_by_group_id_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'product_group_id' => $product->product_group_id,
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
    function test_search_by_make_id_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'make_id' => $product->make_id,
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
    function test_search_by_category_id_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'category_id' => $product->category_id,
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
    function test_search_by_unit_id_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'unit_measure_id' => $product->unit_measure_id,
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
    function test_search_by_presentation_id_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $other_product = factory(Product::class)->create();
        $product = factory(Product::class)->create();
        $params = [
            'product_presentation_id' => $product->product_presentation_id,
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

    public function test_store_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->make();
        $params = [
            'name'                    => $product->name,
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'              => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => $product->price,
            'offer_price'             => $product->offer_price,
        ];

        $this->postJson('/api/products', $params)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $product->name
                ]
            ]);
        $this->assertDatabaseHas('products', $params);
    }

    public function test_validate_product()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $params = [];

        $this->postJson('/api/products', $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'                    => ['El campo nombre es obligatorio.'],
                    'product_presentation_id' => ['El campo presentación es obligatorio.'],
                    'product_group_id'        => ['El campo grupo es obligatorio.'],
                    'unit_measure_id'         => ['El campo medida es obligatorio.'],
                    'make_id'                 => ['El campo marca es obligatorio.'],
                    'minimum_stock'           => ['El campo stock minimo es obligatorio.'],
                    'product_serie_id'        => ['El campo serie es obligatorio.'],
                    'category_id'             => ['El campo categoria es obligatorio.'],
                    'price'                   => ['El campo precio venta es obligatorio.'],
                    'offer_price'             => ['El campo precio descuento es obligatorio.'],
                ]
            ]);
    }

    public function test_validate_unique_product()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->create();
        $params = [
            'name'                    => $product->name,
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'              => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => $product->price,
            'offer_price'             => $product->offer_price,
        ];

        $this->postJson('/api/products', $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'  => ['Ya existe un producto con estas caracteristicas'],
                ]
            ]);
    }

    public function test_update_product()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->create();
        $params = [
            'name'                    => 'Vestido',
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'              => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => $product->price,
            'offer_price'             => $product->offer_price,
        ];

        $this->putJson('/api/products/'.$product->id, $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Vestido'
                ]
            ]);
        $this->assertDatabaseHas('products', $params);
    }
    public function test_validate_update_product()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->create();
        $params = [];

        $this->putJson('/api/products/'.$product->id, $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'                    => ['El campo nombre es obligatorio.'],
                    'product_presentation_id' => ['El campo presentación es obligatorio.'],
                    'product_group_id'        => ['El campo grupo es obligatorio.'],
                    'unit_measure_id'         => ['El campo medida es obligatorio.'],
                    'make_id'                 => ['El campo marca es obligatorio.'],
                    'minimum_stock'           => ['El campo stock minimo es obligatorio.'],
                    'product_serie_id'        => ['El campo serie es obligatorio.'],
                    'category_id'             => ['El campo categoria es obligatorio.'],
                    'price'                   => ['El campo precio venta es obligatorio.'],
                    'offer_price'             => ['El campo precio descuento es obligatorio.'],
                ]
            ]);
    }

    public function test_validate_unique_update_product()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();
        $params = [
            'name'                    => $product->name,
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'              => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => $product->price,
            'offer_price'             => $product->offer_price,
        ];

        $this->putJson('/api/products/'.$product2->id, $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'  => ['Ya existe un producto con estas caracteristicas'],
                ]
            ]);
    }

    public function test_validate_unique_on_same_update_product()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->create();
        $params = [
            'name'                    => $product->name,
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'              => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => $product->price,
            'offer_price'             => $product->offer_price,
        ];

        $this->putJson('/api/products/'.$product->id, $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name'  => $product->name,
                ]
            ]);

        $this->assertDatabaseHas('products', $params);
    }

    public function test_create_order_with_store_product()
    {
        $this->withoutExceptionHandling();
        $order_type    = factory(OrderType::class)->create(['id' => 1]);
        $people        = factory(People::class)->create();
        $warehouse = factory(Warehouse::class)->create(['id' => 1]);
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->make();
        $params = [
            'name'                    => $product->name,
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'             => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => 200,
            'offer_price'             => 150,
            'people_id'               => $people->id,
            'lot'                     => 5,
            'purchase_price'          => 100,
            'make_order'              => true
        ];

        $this->postJson('/api/products', $params)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $product->name
                ]
            ]);
        $this->assertDatabaseHas('products', [
            'name'                    => $product->name,
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'             => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => 200,
            'offer_price'             => 150,
        ]);

        $this->assertDatabaseHas('orders', [
            'people_id' => $people->id,
            'order_type_id' => $order_type->id
        ]);

        $this->assertDatabaseHas('order_details', [
            'order_id' => Order::max('id'),
            'product_id' => Product::max('id'),
            'lot' => 5,
            'purchase_price' => 100,
            'sale_price' => 200,
            'total_purchase' => 500,
        ]);

        $this->assertDatabaseHas('stocks', [
            'stock' => 5,
            'order_detail_id' => OrderDetail::max('id'),
            'warehouse_id' => Warehouse::max('id'),
            'status' => 1
        ]);


    }

    public function test_create_validate_order_with_store_product()
    {
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->make();
        $params = [
            'name'                    => $product->name,
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'             => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => 200,
            'offer_price'             => 150,
            'make_order'              => true
        ];

        $this->postJson('/api/products', $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'purchase_price' => ['El campo Precio compra es obligatorio cuando Crear Pedido es 1.'],
                    'lot'            => ['El campo Cantidad es obligatorio cuando Crear Pedido es 1.'],
                    'people_id'      => ['El campo proveedor es obligatorio cuando Crear Pedido es 1.']
                ]
            ]);

        $this->assertDatabaseMissing('products', [
            'name'                    => $product->name,
            'description'             => $product->description,
            'barcode'                 => $product->barcode,
            'product_presentation_id' => $product->product_presentation_id ,
            'product_serie_id'        => $product->product_serie_id ,
            'product_group_id'        => $product->product_group_id,
            'unit_measure_id'         => $product->unit_measure_id,
            'make_id'                 => $product->make_id,
            'category_id'             => $product->category_id,
            'minimum_stock'           => $product->minimum_stock,
            'price'                   => 200,
            'offer_price'             => 150,
        ]);
    }

    public function test_create_quick_order()
    {
        $this->withoutExceptionHandling();
        $order_type    = factory(OrderType::class)->create(['id' => 1]);
        $people        = factory(People::class)->create();
        $warehouse = factory(Warehouse::class)->create(['id' => 1]);
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->create();
        $params = [
            'make_order'              => true,
            'price'                   => 200,
            'offer_price'             => 150,
            'people_id'               => $people->id,
            'lot'                     => 5,
            'purchase_price'          => 100,
        ];

        $this->postJson('/api/products/'.$product->id.'/quick-orders', $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $product->name
                ]
            ]);

        $this->assertDatabaseHas('orders', [
            'people_id' => $people->id,
            'order_type_id' => $order_type->id
        ]);

        $this->assertDatabaseHas('order_details', [
            'order_id' => Order::max('id'),
            'product_id' => Product::max('id'),
            'lot' => 5,
            'purchase_price' => 100,
            'sale_price' => 200,
            'total_purchase' => 500,
        ]);

        $this->assertDatabaseHas('stocks', [
            'stock' => 5,
            'order_detail_id' => OrderDetail::max('id'),
            'warehouse_id' => Warehouse::max('id'),
            'status' => 1
        ]);


    }
    public function test_validate_quick_order()
    {
        $order_type    = factory(OrderType::class)->create(['id' => 1]);
        $people        = factory(People::class)->create();
        $warehouse = factory(Warehouse::class)->create(['id' => 1]);
        $this->actingAs($this->defaultUser(), 'api');
        $product = factory(Product::class)->create();
        $params = [
            'make_order'              => true,
        ];

        $this->postJson('/api/products/'.$product->id.'/quick-orders', $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'purchase_price' => ['El campo Precio compra es obligatorio cuando Crear Pedido es 1.'],
                    'lot'            => ['El campo Cantidad es obligatorio cuando Crear Pedido es 1.'],
                    'people_id'      => ['El campo proveedor es obligatorio cuando Crear Pedido es 1.']
                ]
            ]);

        $this->assertDatabaseMissing('orders', [
            'people_id' => $people->id,
            'order_type_id' => $order_type->id
        ]);
    }


}

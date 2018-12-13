<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EmejiasInventory\Entities\OrderType;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Entities\StockHistory;

class TransferTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_tranfers()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');

        factory(OrderType::class)->create(['id' => OrderType::Transfer ]);
        $transfer = factory(Order::class)->create(['order_type_id' => OrderType::Transfer ]);


        $this->getJson('/api/transfers', $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'status' => 'Creado'
                    ]
                ]
            ]);
    }

    function test_create_a_transfer()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');

        factory(OrderType::class)->create(['id' => OrderType::Transfer ]);


        $this->postJson('/api/transfers', $params)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'status' => 'Creado'
                ]
            ]);

        $this->assertDatabaseHas('orders', [
            'status'           => 'Creado',
            'order_type_id'    => OrderType::Transfer,
            'user_id'          => $user->id
        ]);

    }

    public function test_store_transfer_detail()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $people = factory(People::class)->create();
        $order_type = factory(OrderType::class)->create(['id' => 1]);
        $order = factory(Order::class)->create(['order_type_id' =>  $order_type->id]);
        $order_detail = factory(OrderDetail::class)->create([
            'order_id' => $order->id,
            'lot' => 5,
            'purchase_price' => 10,
            'sale_price' => 20,
            'total_purchase' => 200
        ]);


        $stock = factory(Stock::class)->create([
            'order_detail_id' => $order_detail->id,
            'stock' => 5,
        ]);

        $order_type = factory(OrderType::class)->create(['id' => 2]);
        $cash_register = factory(CashRegister::class)->create();
        $invoice = factory(Order::class)->create([
            'order_type_id'    => $order_type->id,
            'cash_register_id' => $cash_register->id,
            'status'           => 'Creado'
        ]);

        $params = [
            'invoice_id'  => $invoice->id,
            'product_id'  => $order_detail->product_id,
            'lot'         => '5',
            'price'       => 20,
            'offer_price' => 15
        ];

        $this->postJson('/api/invoice-details', $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => ['id' => $invoice->id]
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $invoice->id,
            'total' => '75'
        ]);
        $this->assertDatabaseHas('order_details', [
            'order_id'=> $invoice->id,
            'lot' => 5,
            'product_id' => $order_detail->product_id,
        ]);
        $this->assertDatabaseHas('stocks', [
            'id' => $stock->id,
            'stock' => 0,
            'status' => 0
        ]);
    }

    public function test_destroy_transfer_detail()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $people = factory(People::class)->create();
        $order_type = factory(OrderType::class)->create(['id' => 1]);
        $order = factory(Order::class)->create(['order_type_id' =>  $order_type->id]);
        $order_detail = factory(OrderDetail::class)->create([
            'order_id' => $order->id,
            'lot' => 5,
            'purchase_price' => 10,
            'sale_price' => 20,
            'total_purchase' => 200
        ]);


        $stock = factory(Stock::class)->create([
            'order_detail_id' => $order_detail->id,
            'stock' => 0,
        ]);

        $order_type = factory(OrderType::class)->create(['id' => 2]);
        $cash_register = factory(CashRegister::class)->create();
        $invoice = factory(Order::class)->create([
            'order_type_id'    => $order_type->id,
            'cash_register_id' => $cash_register->id,
            'status'           => 'Creado'
        ]);
        $invoice_detail = factory(OrderDetail::class)->create([
            'order_id'=> $invoice->id,
            'lot' => 5,
            'product_id' => $order_detail->product_id,
        ]);
        $stock_history = factory(StockHistory::class)->create([
            'stock_id' => $stock->id,
            'order_id' => $invoice->id,
            'order_detail_id' => $invoice_detail->id,
            'lot' => 5,
        ]);
        $this->deleteJson('/api/invoice-details/'.$invoice_detail->id)
            ->assertStatus(200)
            ->assertJson([
                'data' => ['id' => $invoice->id]
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $invoice->id,
            'total' => 0
        ]);
        $this->assertDatabaseMissing('order_details', [
            'order_id'=> $invoice->id,
            'lot' => 5,
            'product_id' => $order_detail->product_id,
        ]);
        $this->assertDatabaseHas('stocks', [
            'id' => $stock->id,
            'stock' => 5,
            'status' => 1
        ]);
    }

    public function test_store_with_2_stoks_transfer_detail()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $people = factory(People::class)->create();
        $order_type = factory(OrderType::class)->create(['id' => 1]);
        $product = factory(Product::class)->create();
        $order = factory(Order::class)->create(['order_type_id' =>  $order_type->id]);
        $order_detail = factory(OrderDetail::class)->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'lot' => 5,
            'purchase_price' => 10,
            'sale_price' => 20,
            'total_purchase' => 200
        ]);
        $stock = factory(Stock::class)->create([
            'order_detail_id' => $order_detail->id,
            'stock' => 5,
        ]);

        $othe_order = factory(Order::class)->create(['order_type_id' =>  $order_type->id]);
        $othe_order_detail = factory(OrderDetail::class)->create([
            'order_id' => $othe_order->id,
            'product_id' => $product->id,
            'lot' => 5,
            'purchase_price' => 10,
            'sale_price' => 20,
            'total_purchase' => 200
        ]);
        $other_stock = factory(Stock::class)->create([
            'order_detail_id' => $othe_order_detail->id,
            'stock' => 5,
        ]);

        $order_type = factory(OrderType::class)->create(['id' => 2]);
        $cash_register = factory(CashRegister::class)->create();
        $invoice = factory(Order::class)->create([
            'order_type_id'    => $order_type->id,
            'cash_register_id' => $cash_register->id,
            'status'           => 'Creado'
        ]);

        $params = [
            'invoice_id'  => $invoice->id,
            'product_id'  => $order_detail->product_id,
            'lot'         => 9,
            'price'       => 20,
            'offer_price' => 15
        ];

        $this->postJson('/api/invoice-details', $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => ['id' => $invoice->id]
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $invoice->id,
            'total' => '135'
        ]);
        $this->assertDatabaseHas('order_details', [
            'order_id'=> $invoice->id,
            'lot' => 9,
            'product_id' => $order_detail->product_id,
        ]);
        $this->assertDatabaseHas('stocks', [
            'id' => $stock->id,
            'stock' => 0,
            'status' => 0
        ]);

        $this->assertDatabaseHas('stocks', [
            'id' => $other_stock->id,
            'stock' => 1,
            'status' => 1
        ]);
    }

    public function test_destroy_transfer_detail_with_2_stoks()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $people = factory(People::class)->create();
        $order_type = factory(OrderType::class)->create(['id' => 1]);
        $product = factory(Product::class)->create();
        $order = factory(Order::class)->create(['order_type_id' =>  $order_type->id]);
        $order_detail = factory(OrderDetail::class)->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'lot' => 5,
            'purchase_price' => 10,
            'sale_price' => 20,
            'total_purchase' => 200
        ]);
        $stock = factory(Stock::class)->create([
            'order_detail_id' => $order_detail->id,
            'stock' => 0,
            'status' => 0
        ]);

        $othe_order = factory(Order::class)->create(['order_type_id' =>  $order_type->id]);
        $othe_order_detail = factory(OrderDetail::class)->create([
            'order_id' => $othe_order->id,
            'product_id' => $product->id,
            'lot' => 5,
            'purchase_price' => 10,
            'sale_price' => 20,
            'total_purchase' => 200
        ]);
        $other_stock = factory(Stock::class)->create([
            'order_detail_id' => $othe_order_detail->id,
            'stock' => 1,
        ]);

        $order_type = factory(OrderType::class)->create(['id' => 2]);
        $cash_register = factory(CashRegister::class)->create();

        $invoice = factory(Order::class)->create([
            'order_type_id'    => $order_type->id,
            'cash_register_id' => $cash_register->id,
            'status'           => 'Creado'
        ]);
        $invoice_detail = factory(OrderDetail::class)->create([
            'order_id'=> $invoice->id,
            'lot' => 9,
            'product_id' => $order_detail->product_id,
        ]);
        $stock_history = factory(StockHistory::class)->create([
            'stock_id' => $stock->id,
            'order_id' => $invoice->id,
            'order_detail_id' => $invoice_detail->id,
            'lot' => 5,
        ]);
        $stock_history = factory(StockHistory::class)->create([
            'stock_id' => $other_stock->id,
            'order_id' => $invoice->id,
            'order_detail_id' => $invoice_detail->id,
            'lot' => 4,
        ]);

        $this->deleteJson('/api/invoice-details/'.$invoice_detail->id)
            ->assertStatus(200)
            ->assertJson([
                'data' => ['id' => $invoice->id]
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $invoice->id,
            'total' => 0
        ]);
        $this->assertDatabaseMissing('order_details', [
            'order_id'=> $invoice->id,
            'lot' => 5,
            'product_id' => $order_detail->product_id,
        ]);

        $this->assertDatabaseHas('stocks', [
            'id' => $stock->id,
            'stock' => 5,
            'status' => 1
        ]);

        $this->assertDatabaseHas('stocks', [
            'id' => $other_stock->id,
            'stock' => 5,
            'status' => 1
        ]);
    }

}

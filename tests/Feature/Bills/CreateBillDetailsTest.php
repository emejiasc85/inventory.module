<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\StockHistory;
use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;

class CreateBillDetailsTest extends FeatureTestCase
{
    function test_user_can_add_products_to_bills()
    {
        //having
        $user = $this->defaultuser();
        $this->actingAs($user);
        Artisan::call('db:seed', ['--class' => 'CommerceTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'PeopleTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $bill = factory(Order::class)->create([
            'people_id' => 1,
            'order_type_id' => 2,
            'user_id' => $user->id,
        ]);
        $order  = factory(Order::class)->create(['order_type_id' => 1]);
        $detail = factory(OrderDetail::class)->create(['order_id' =>  $order->id, 'product_id' => 1, 'purchase_price' => 10, 'sale_price' => 15]);
        $stock  = factory(Stock::class)->create(['order_detail_id' => $detail->id, 'stock' => $detail->lot]);

        $order2  = factory(Order::class)->create(['order_type_id' => 1]);
        $detail2 = factory(OrderDetail::class)->create(['order_id' =>  $order2->id, 'product_id' => 1, 'purchase_price' => 10, 'sale_price' => 15]);
        $stock2  = Stock::create(['order_detail_id' => $detail2->id, 'stock' => $detail2->lot, 'warehouse_id' => 1]);
         //when
        $this->visit(route('bills.details', $bill));
        //$this->type('Viagra', 'name');
        //$this->press('');
        $this->seePageIs(route('bills.details', $bill));
        $this->type(1, 'product_id');
        $this->type(7, 'lot');
        $this->type(15, 'sale_price');
        $this->press('Agregar');
        $this->seePageIs(route('bills.details', $bill));

        //then
        $this->seeInDatabase('stocks', [
            'id' => $stock->id,
            'status' => false,
            'stock' => 0
        ]);
        $this->seeInDatabase('stocks', [
            'id' => $stock2->id,
            'status' => true,
            'stock' => 3
        ]);
        $this->seeInDatabase('stock_histories', [
            'stock_id' => $stock2->id,
            'order_id' => $bill->id,
            //'order_detail_id' => $detail->id,
            'lot' => 2
        ]);
        $this->seeInDatabase('stock_histories', [
            'stock_id' => $stock->id,
            'order_id' => $bill->id,
            //'order_detail_id' => $detail->id,
            'lot' => 5
        ]);
    }
}

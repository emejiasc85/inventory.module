<?php

namespace tests\Feature;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Stock;
use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;


class ListStocksTest extends FeatureTestCase
{
    function test_a_user_can_see_stock_list()
    {
        //having
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        $order  = factory(Order::class)->create(['order_type_id' => 1]);
        $detail = factory(OrderDetail::class)->create(['order_id' =>  $order->id]);
        $stock  = factory(Stock::class)->create(['order_detail_id' => $detail->id, 'stock' => $detail->lot]);
        $this->actingAs($this->defaultUser());
        //when
        $this->visit(route('stocks.index'));
        //then
        $this->see('Existencias')
        ->seeInElement('td', $stock->detail->product->id)
        ->seeInElement('td', $stock->detail->product->name)
        ->seeInElement('td', $stock->detail->sale_price)
        ->seeInElement('td', $stock->detail->due_date)
        ->seeInElement('td', $stock->stock);
    }
}

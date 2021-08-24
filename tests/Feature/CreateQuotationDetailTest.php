<?php

namespace tests\Feature;

use EmejiasInventory\Entities\{Stock,Order,OrderDetail};
use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;


class CreateQuotationDetailTest extends FeatureTestCase
{
    function test_user_can_add_products_to_quotes()
    {
        //having
        /*
        $user = $this->defaultuser();
        $this->actingAs($user);
        Artisan::call('db:seed', ['--class' => 'CommerceTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'PeopleTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $quotation = factory(Order::class)->create([
            'people_id'     => 1,
            'order_type_id' => 2,
            'user_id'       => $user->id,
        ]);
        $order  = factory(Order::class)->create(['order_type_id' => 1]);
        $detail = factory(OrderDetail::class)->create(['order_id' =>  $order->id, 'product_id' => 1, 'purchase_price' => 10, 'sale_price' => 15]);
        $stock  = factory(Stock::class)->create(['order_detail_id' => $detail->id, 'stock' => $detail->lot]);

        $order2  = factory(Order::class)->create(['order_type_id' => 1]);
        $detail2 = factory(OrderDetail::class)->create(['order_id' =>  $order2->id, 'product_id' => 1, 'purchase_price' => 10, 'sale_price' => 15]);
        $stock2  = Stock::create(['order_detail_id' => $detail2->id, 'stock' => $detail2->lot, 'warehouse_id' => 1]);
         //when
        $this->visit(route('quotes.details', $quotation));

        $this->seePageIs(route('quotes.details', $quotation));
        $this->type(1, 'product_id');
        $this->type(7, 'lot');
        $this->type(15, 'sale_price');
        $this->press('Agregar');
        $this->seePageIs(route('quotes.details', $quotation));

        //then
        //verify insert on table
        */
    }
}

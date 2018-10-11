<?php

use Faker\Generator as Faker;
use EmejiasInventory\Entities\Warehouse;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\Stock;

$factory->define(EmejiasInventory\Entities\StockHistory::class, function (Faker $faker) {

    return [
        'order_id' => function ()
        {
            return factory(Order::class)->create()->id;
        },
        'order_detail_id' => function ()
        {
            return factory(OrderDetail::class)->create()->id;
        },
        'stock_id' => function(){
            return factory(Stock::class)->create()->id;
        },
        'lot' => $faker->randomDigitNotNull
    ];
});

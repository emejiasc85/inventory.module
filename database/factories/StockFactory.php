<?php

use Faker\Generator as Faker;
use EmejiasInventory\Entities\Warehouse;
use EmejiasInventory\Entities\OrderDetail;

$factory->define(EmejiasInventory\Entities\Stock::class, function (Faker $faker) {

    return [
        'order_detail_id' => function ()
        {
            return factory(OrderDetail::class)->create()->id;
        },
        'stock' => $faker->randomDigitNotNull,
        'warehouse_id'=>  function ()
        {
            return factory(Warehouse::class)->create()->id;
        }
    ];
});

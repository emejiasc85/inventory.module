<?php

use Faker\Generator as Faker;
use EmejiasInventory\Entities\User;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\Product;

$factory->define(EmejiasInventory\Entities\OrderDetail::class, function (Faker $faker) {
    return [
        'order_id'  => function (){
            return factory(Order::class)->create()->id;
        },
        'product_id'  => function () {
            return factory(Product::class)->create()->id;
        },
        'lot' => 5,
    ];
});

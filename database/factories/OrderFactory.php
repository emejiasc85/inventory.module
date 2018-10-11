<?php

use Faker\Generator as Faker;
use EmejiasInventory\Entities\User;
use EmejiasInventory\Entities\OrderType;
use EmejiasInventory\Entities\People;

$factory->define(EmejiasInventory\Entities\Order::class, function (Faker $faker) {
    return [
        'people_id'   => function (){
            return factory(People::class)->create()->id;
        },
        'user_id'   => function (){
            return factory(User::class)->create()->id;
        },
        'priority' => 'Baja',
        'order_type_id' => function()
        {
            return factory(OrderType::class)->create()->id;
        },
        'status' => $faker->randomElement(['Creado','Solicitado','Ingresado','Cancelado'])
    ];
});

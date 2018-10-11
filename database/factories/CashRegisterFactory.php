<?php

use Faker\Generator as Faker;
use EmejiasInventory\Entities\User;

$factory->define(EmejiasInventory\Entities\CashRegister::class, function (Faker $faker) {
    return [
        'user_id' => function ()
        {
            return factory(User::class)->create()->id;
        },
        'initial_cash'=> $faker->randomDigitNotNull,
    ];
});

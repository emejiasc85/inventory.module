<?php

use Faker\Generator as Faker;
use EmejiasInventory\Entities\User;
use EmejiasInventory\Entities\CashRegister;

$factory->define(EmejiasInventory\Entities\CashRegisterDeposit::class, function (Faker $faker) {
    return [
        'cash_register_id' => function (){
            return factory(CashRegister::class)->create()->id;
        },
        'baucher' => $faker->randomDigit,
        'amount' => $faker->randomDigit,
        'bank' => $faker->name,
        'account' => $faker->bankAccountNumber,
        'date' =>  $faker->date()
    ];
});

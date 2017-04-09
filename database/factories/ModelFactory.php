<?php

use EmejiasInventory\Entities\{
        User,
        Commerce,
        Make,
        ProductGroup,
        ProductPresentation,
        UnitMeasure,
        Product,
        ProductImage,
        Warehouse,
        OrderType,
        OrderDetail
    };
use EmejiasInventory\Entities\Order;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Commerce::class, function (Faker\Generator $faker) {

    $name = $faker->company;
    return [
        'name' => $name,
    	'patent_name' => $name,
    	'patent' => $faker->randomNumber,
    	'address' => $faker->address,
    	'phone' =>  $faker->e164PhoneNumber,
    	'other_phone' => $faker->e164PhoneNumber,
    	'nit' => $faker->randomNumber,
    	'tax' => 3,
    	'profit' => 10,
    ];
});


$factory->define(Make::class, function (Faker\Generator $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
    ];
});
$factory->define(OrderType::class, function (Faker\Generator $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'description' => $faker->paragraph
    ];
});
$factory->define(UnitMeasure::class, function (Faker\Generator $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
    ];
});

$factory->define(ProductGroup::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
    ];
});
$factory->define(ProductPresentation::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
    ];
});
$factory->define(Warehouse::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
    ];
});
$factory->define(Product::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name'          => $name,
        'full_name'     => $name,
        'description'   => $faker->paragraph,
        'barcode'       => $faker->ean13,
        'product_presentation_id' => function () {
            return factory(ProductPresentation::class)->create()->id;
        },
        'product_group_id'  => function () {
            return factory(ProductGroup::class)->create()->id;
        },
        'unit_measure_id'   => function () {
            return factory(UnitMeasure::class)->create()->id;
        },
        'make_id'   => function () {
            return factory(Make::class)->create()->id;
        },
        'minimum_stock'     => 5,
    ];
});
$factory->define(ProductImage::class, function (Faker\Generator $faker) {
    return [
        'description'   => $faker->name,
        'product_id'   => function () {
            return factory(Product::class)->create()->id;
        },
        'img_path' => public_path('img/picture.svg')
    ];
});
$factory->define(Order::class, function (Faker\Generator $faker) {
    return [
        'provider_id'   => function (){
            return factory(User::class)->create()->id;
        },
        'user_id'   => function (){
            return factory(User::class)->create()->id;
        },
        'priority' => 'Baja'
    ];
});
$factory->define(OrderDetail::class, function (Faker\Generator $faker) {
    return [
        'order_id'   => function (){
            return factory(Order::class)->create()->id;
        },
        'product_id'   => function () {
            return factory(Product::class)->create()->id;
        },
        'lot'       => 5,
    ];
});
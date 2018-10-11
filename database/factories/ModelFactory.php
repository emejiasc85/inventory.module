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
        OrderDetail,
        Stock,
        People,
        Resolution,
        Role
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
        'name'           => $faker->name,
        'username'       => $faker->username,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = 'secret',
        'remember_token' => str_random(10),
        'api_token' => str_random(10),
        'role_id'        => function ()
        {
            return factory(Role::class)->create()->id;
        }
    ];
});

$factory->define(Commerce::class, function (Faker\Generator $faker) {

    $name = $faker->company;
    return [
        'name'        => $name,
        'patent_name' => $name,
        'patent'      => $faker->randomNumber,
        'address'     => $faker->address,
        'phone'       =>  $faker->e164PhoneNumber,
        'other_phone' => $faker->e164PhoneNumber,
        'nit'         => $faker->randomNumber,
        'tax'         => 3,
        'profit'      => 10,
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
        'commerce_id' => function ()
        {
            return factory(Commerce::class)->create()->id;
        }
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
$factory->define(Resolution::class, function (Faker\Generator $faker){
    return [
        'resolution' => $faker->name ,
        'serie' => $faker->randomLetter,
        'from' => 1,
        'to' => 1000,
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'commerce_id' => function ()
        {
            return factory(Commerce::class)->create()->id;
        }
    ];
});
$factory->define(Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

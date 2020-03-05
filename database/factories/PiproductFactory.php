<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Piproduct;
use Faker\Generator as Faker;

$factory->define(Piproduct::class, function (Faker $faker) {
    return [
        'product_name' => $faker->name,
        'product_stock' => $faker->numberBetween(1,5),
        'product_price' => $faker->numberBetween(500,1000),
        'product_qty' => $faker->numberBetween(1, 5),
        'product_dis' => $faker->numberBetween(5,20),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
         'p_name' => $faker->name,
        'p_qty' => rand(1,50),
        'p_buy_price' => rand(1,500),
        'p_sell_price' => rand(1,500),
        'p_unique_id' => "Pro".Str::random(3),
    ];
});

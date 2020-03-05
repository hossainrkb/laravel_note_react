<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Postint;
use Faker\Generator as Faker;

$factory->define(Postint::class, function (Faker $faker) {
    return [
        "post_name" => $faker->name,
        "post_qty" => rand(1,5),
        "post_price" => rand(1000,5000),
        "post_status" => rand(1,3),
    ];
});

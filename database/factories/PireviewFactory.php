<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Pireview;
use Faker\Generator as Faker;

$factory->define(Pireview::class, function (Faker $faker) {
    return [
        'review_descrip' => $faker->paragraph,
        'review_product_id' => $faker->numberBetween(1, 50),
        'review_star' => $faker->numberBetween(1,5),
    ];
});

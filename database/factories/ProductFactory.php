<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomFloat(2, 1, 100),
        'quantity' => $faker->numberBetween(10,20),
    ];
});

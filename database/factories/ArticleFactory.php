<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'code' => $faker->unique()->slug(3),
        'description' => $faker->text,
        'price' => $faker->randomNumber(3),
    ];
});

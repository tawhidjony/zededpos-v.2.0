<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Pro_model::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName,
    ];
});

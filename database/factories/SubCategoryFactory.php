<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Sub_category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName,
    ];
});

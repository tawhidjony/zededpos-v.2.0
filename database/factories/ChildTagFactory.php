<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\ChildTag;
use Faker\Generator as Faker;

$factory->define(ChildTag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName,
    ];
});

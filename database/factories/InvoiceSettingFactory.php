<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use Faker\Generator as Faker;

$factory->define(App\Models\Invoice_setting::class, function (Faker $faker) {
    return [
        'shop_name' => $faker->name,
    ];
});

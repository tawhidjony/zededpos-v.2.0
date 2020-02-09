<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Customer::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'photo' =>'customers/QRdfdG5Nb4MhjR6jeJP9W0qzZXGuHFQ79c3ZUsb8.jpeg',
        'address' => $faker->address,
        'about' => $faker->text($maxNbChars = 50),

		//'picture' => $faker->image($filePath,400,300)
        //'photo' => $faker->imageUrl('/images/customers',400,300)
    ];
});

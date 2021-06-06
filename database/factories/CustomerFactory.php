<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Customer::class, function (Faker $faker) {
    $gender = $faker->randomElement(['M', 'F']);
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'document' => $faker->unique()->ean8,
        'phone' => $faker->ean8,
        'city' => $faker->city,
        'province' => $faker->country,
        'address' => $faker->address,
        'gender' => $gender,
        'email' => $faker->unique()->email,
        'status' => 1,
        'img' => 'avatar.svg',
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Route::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->city,
        'description' => $faker->text($maxNbChars = 50)
    ];
});

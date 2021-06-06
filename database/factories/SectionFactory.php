<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Section::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->text($maxNbChars = 25),
        'description' => $faker->text($maxNbChars = 100)
    ];
});

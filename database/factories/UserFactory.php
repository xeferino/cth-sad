<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(\App\User::class, function (Faker $faker) {
    $role = $faker->randomElement(['administer', 'pollster']);
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->email,
        'password' => Hash::make('12345678'),
        'status' => 1,
        'email_verified_at' => now(),
        'role' => $role,
        'remember_token' => Str::random(10),
        'img' => 'avatar.svg',
    ];
});

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\Customer::class, 50)->create();
       //factory(\App\Poll::class, 50)->create();
       //factory(\App\Route::class, 50)->create();
        //factory(\App\Section::class, 50)->create();
        //factory(\App\User::class, 50)->create();

        DB::table('users')->insert([
            'name' => "Admin",
            'last_name' => "Example",
            'email' => "admin@example.com",
            'password' => Hash::make('12345678'),
            'status' => 1,
            'email_verified_at' => now(),
            'role' => "super",
            'remember_token' => Str::random(10),
            'img' => 'avatar.svg',
        ]);
    }
}

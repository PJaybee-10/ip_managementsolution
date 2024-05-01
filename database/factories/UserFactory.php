<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => Carbon::now(),
        'password' => Hash::make('password'), // Generate hashed password
        'remember_token' => Str::random(10),
    ];
});

<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Admin::class, function(Faker\Generator $faker){
    static $fill_data;
    return [
        'name' => $fill_data['name'],
        'username' => $fill_data['username'],
        'password' => $fill_data['password'],
        'level' => $fill_data['level'],
        'created_at' => Carbon::now()
    ];
});

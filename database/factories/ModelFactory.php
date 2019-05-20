<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

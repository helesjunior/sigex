<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\HigherOrgan;
use Faker\Generator as Faker;

$factory->define(HigherOrgan::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(4),
        'name' => $faker->name(),
        'status' => $faker->boolean()
    ];
});

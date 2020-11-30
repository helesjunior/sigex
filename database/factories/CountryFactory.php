<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    $name = $faker->country;

    return [
        'name' => $name,
        'abbreviation' => \Illuminate\Support\Str::of($name)->substr(0, 3)->upper(),
        'latitude' => $faker->randomNumber(4),
        'longitude' => $faker->randomNumber(4),
        'status' => $faker->boolean()
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\State;
use Faker\Generator as Faker;

$factory->define(State::class, function (Faker $faker) {
    $name = $faker->state;

    return [
        'country_id' => \App\Models\Country::all()->random()->id,
        'is_capital' => $faker->boolean(),
        'name' => $name,
        'abbreviation' => \Illuminate\Support\Str::of($name)->substr(0, 3)->upper(),
        'latitude' => $faker->randomNumber(6),
        'longitude' => $faker->randomNumber(6),
        'status' => $faker->boolean()
    ];
});

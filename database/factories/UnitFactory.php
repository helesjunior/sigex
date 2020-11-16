<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Unit;
use Faker\Generator as Faker;

$factory->define(Unit::class, function (Faker $faker) {
    $name = $faker->company;

    return [
        'organ_id' => \App\Models\Organ::all()->random()->id,
        'code' => $faker->randomNumber(6),
        'name' => $name,
        'short_name' => \Illuminate\Support\Str::of($name)->substr(0, 6)->upper(),
        'phone' => $faker->phoneNumber(20),
        'currency_id' => \App\Models\Currency::all()->random()->id,
        'city_id' => null,
        'state_id' => null,
        'country_id' => null,
        'type_id' => 0,
        'status' => $faker->boolean,
        // campos extras?
    ];
});

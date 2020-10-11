<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Organ;
use Faker\Generator as Faker;

$factory->define(Organ::class, function (Faker $faker) {
    return [
        'higher_organ_id' => \App\Models\HigherOrgan::all()->random()->id,
        'code' => $faker->randomNumber(4),
        'name' => $faker->name(),
        'status' => $faker->boolean()
    ];
});

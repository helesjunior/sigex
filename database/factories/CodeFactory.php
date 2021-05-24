<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Codigo;
use Faker\Generator as Faker;

$factory->define(Codigo::class, function (Faker $faker) {
    return [
        'description' => $faker->domainName(),
        'is_visible' => $faker->boolean()
    ];
});

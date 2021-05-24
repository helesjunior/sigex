<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CodigoItem;
use Faker\Generator as Faker;

$factory->define(CodigoItem::class, function (Faker $faker) {
    return [
        'code_id' => \App\Models\Codigo::all()->random()->id,
        'description' => $faker->domainName(),
        'is_visible' => $faker->boolean()
    ];
});

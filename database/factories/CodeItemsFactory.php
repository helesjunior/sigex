<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CodeItem;
use Faker\Generator as Faker;

$factory->define(CodeItem::class, function (Faker $faker) {
    return [
        'code_id' => \App\Models\Code::all()->random()->id,
        'description' => $faker->domainName(),
        'is_visible' => $faker->boolean()
    ];
});

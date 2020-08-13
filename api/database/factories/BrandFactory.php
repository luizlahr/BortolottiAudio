<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Borto\Infrastructure\DB\Models\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        "name" => $faker->word
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Borto\Infrastructure\DB\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        "name" => $faker->word
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Borto\Infrastructure\DB\Models\Brand;
use Borto\Infrastructure\DB\Models\Category;
use Borto\Infrastructure\DB\Models\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        "name"        => $this->faker->name,
        "category_id" => factory(Category::class)->create(),
        "brand_id"    => factory(Brand::class),
    ];
});

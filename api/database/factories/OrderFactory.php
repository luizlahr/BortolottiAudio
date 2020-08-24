<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Borto\Infrastructure\DB\Models\Order;
use Borto\Infrastructure\DB\Models\Person;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Order::class, function (Faker $faker) {
    return [
        "status"       => $faker->randomElement([1, 2, 3, 4, 5, 6, 7]),
        "credit"       => $faker->randomFloat(2, 10, 500),
        "customer_id"  => factory(Person::class)->create(["supplier" => false]),
        "due_to"       => $faker->dateTime('2020-01-01'),
        "quoted_at"    => $faker->dateTime('2020-01-01'),
        "approved_at"  => $faker->dateTime('2020-01-01'),
        "finished_at"  => $faker->dateTime('2020-01-01'),
        "delivered_at" => $faker->dateTime('2020-01-01'),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Borto\Infrastructure\DB\Models\Model;
use Borto\Infrastructure\DB\Models\Order;
use Borto\Infrastructure\DB\Models\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        "order_id"      => factory(Order::class)->create(),
        "type"          => null,
        "model_id"      => null,
        "serial_number" => null,
        "notes"         => null,
        "name"          => null,
        "amount"        => null,
        "measure"       => null,
        "value"         => $faker->randomFloat(2, 10, 200),
    ];
});

$factory->state(OrderItem::class, 'maintenance', function (Faker $faker) {
    return [
        "type"          => 'M',
        "model_id"      => factory(Model::class)->create(),
        "serial_number" => $faker->word,
        "notes"         => $faker->text(200),
    ];
});

$factory->state(OrderItem::class, 'sale', function (Faker $faker) {
    return [
        "type"    => 'S',
        "name"    => $faker->name,
        "amount"  => $faker->randomDigitNotNull,
        "measure" => 'UN',
    ];
});

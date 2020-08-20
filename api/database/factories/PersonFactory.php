<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Borto\Infrastructure\DB\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        "business"     => $faker->boolean,
        "supplier"     => $faker->boolean,
        "name"         => $faker->name,
        "nickname"     => $faker->name,
        "email"        => $faker->email,
        "mobile"       => $faker->cellphone,
        "whatsapp"     => $faker->boolean,
        "phone"        => $faker->landline,
        "nid"          => $faker->rg(false),
        "ssn"          => $faker->cpf(false),
        "zipcode"      => $faker->postcode,
        "street"       => $faker->streetName,
        "streetNumber" => $faker->buildingNumber,
        "neighborhood" => $faker->city,
        "city"         => $faker->city,
        "state"        => $faker->stateAbbr,
    ];
});

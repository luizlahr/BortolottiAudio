<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Person\Entities;

use Borto\Domain\Person\Entities\AddressEntity;
use Tests\BaseTestCase;

class AddressEntityTest extends BaseTestCase
{
    public function testItCanCreateAnAddressEntity(): void
    {
        $zipcode = $this->faker->postcode;
        $street = $this->faker->streetName;
        $streetNumber = $this->faker->buildingNumber;
        $neighborhood = $this->faker->city;
        $city = $this->faker->city;
        $state = $this->faker->stateAbbr;

        $entity = new AddressEntity(
            $zipcode,
            $street,
            $streetNumber,
            $neighborhood,
            $city,
            $state
        );

        $this->assertEquals($entity->getZipcode(), $zipcode);
        $this->assertEquals($entity->getStreet(), $street);
        $this->assertEquals($entity->getStreetNumber(), $streetNumber);
        $this->assertEquals($entity->getNeighborhood(), $neighborhood);
        $this->assertEquals($entity->getCity(), $city);
        $this->assertEquals($entity->getState(), $state);
    }

    public function testItCanConvertAnAddressEntityToArray(): void
    {
        $zipcode = $this->faker->postcode;
        $street = $this->faker->streetName;
        $streetNumber = $this->faker->buildingNumber;
        $neighborhood = $this->faker->city;
        $city = $this->faker->city;
        $state = $this->faker->stateAbbr;

        $entity = new AddressEntity(
            $zipcode,
            $street,
            $streetNumber,
            $neighborhood,
            $city,
            $state
        );

        $this->assertEquals($entity->getState(), $state);


        $this->assertEquals($entity->toArray(), [
            "zipcode"      => $zipcode,
            "street"       => $street,
            "streetNumber" => $streetNumber,
            "neighborhood" => $neighborhood,
            "city"         => $city,
            "state"        => $state
        ]);
    }
}

<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Person\Entities;

use Borto\Domain\Person\Entities\PersonRequestEntity;
use Tests\BaseTestCase;

class PersonRequestEntityTest extends BaseTestCase
{
    public function testItCanCreateAPersonRequestEntity(): void
    {
        $supplier = $this->faker->boolean;
        $business = $this->faker->boolean;
        $name = $this->faker->name;
        $nickname = $this->faker->name;
        $email = $this->faker->email;
        $mobile = $this->fakerBR->cellphone;
        $whatsapp = $this->faker->boolean;
        $phone = $this->fakerBR->landline;
        $nid = $this->fakerBR->rg(false);
        $ssn = $this->fakerBR->cpf(false);
        $zipcode = $this->faker->postcode;
        $street = $this->faker->streetName;
        $streetNumber = $this->faker->buildingNumber;
        $neighborhood = $this->faker->city;
        $city = $this->faker->city;
        $state = $this->faker->stateAbbr;

        $entity = new PersonRequestEntity([
            "business"     => $business,
            "name"         => $name,
            "nickname"     => $nickname,
            "email"        => $email,
            "mobile"       => $mobile,
            "whatsapp"     => $whatsapp,
            "phone"        => $phone,
            "nid"          => $nid,
            "ssn"          => $ssn,
            "zipcode"      => $zipcode,
            "street"       => $street,
            "streetNumber" => $streetNumber,
            "neighborhood" => $neighborhood,
            "city"         => $city,
            "state"        => $state
        ]);

        $supplier = $this->faker->boolean;

        if ($supplier) {
            $entity->setSupplier();
        } else {
            $entity->setCustomer();
        }

        $this->assertEquals($entity->isBusiness(), $business);
        $this->assertEquals($entity->getName(), $name);
        $this->assertEquals($entity->getNickname(), $nickname);
        $this->assertEquals($entity->getEmail(), $email);
        $this->assertEquals($entity->getMobile(), $mobile);
        $this->assertEquals($entity->isWhatsapp(), $whatsapp);
        $this->assertEquals($entity->getPhone(), $phone);
        $this->assertEquals($entity->getNid(), $nid);
        $this->assertEquals($entity->getSsn(), $ssn);
        $this->assertEquals($entity->getZipcode(), $zipcode);
        $this->assertEquals($entity->getStreet(), $street);
        $this->assertEquals($entity->getStreetNumber(), $streetNumber);
        $this->assertEquals($entity->getNeighborhood(), $neighborhood);
        $this->assertEquals($entity->getCity(), $city);
        $this->assertEquals($entity->getState(), $state);
    }

    public function testItCanConvertAPersonRequestEntityToArray(): void
    {
        $supplier = $this->faker->boolean;
        $business = $this->faker->boolean;
        $name = $this->faker->name;
        $nickname = $this->faker->name;
        $email = $this->faker->email;
        $mobile = $this->fakerBR->cellphone;
        $whatsapp = $this->faker->boolean;
        $phone = $this->fakerBR->landline;
        $nid = $this->fakerBR->rg(false);
        $ssn = $this->fakerBR->cpf(false);
        $zipcode = $this->faker->postcode;
        $street = $this->faker->streetName;
        $streetNumber = $this->faker->buildingNumber;
        $neighborhood = $this->faker->city;
        $city = $this->faker->city;
        $state = $this->faker->stateAbbr;

        $entity = new PersonRequestEntity([
            "business"     => $business,
            "name"         => $name,
            "nickname"     => $nickname,
            "email"        => $email,
            "mobile"       => $mobile,
            "whatsapp"     => $whatsapp,
            "phone"        => $phone,
            "nid"          => $nid,
            "ssn"          => $ssn,
            "zipcode"      => $zipcode,
            "street"       => $street,
            "streetNumber" => $streetNumber,
            "neighborhood" => $neighborhood,
            "city"         => $city,
            "state"        => $state
        ]);

        $supplier = $this->faker->boolean;

        if ($supplier) {
            $entity->setSupplier();
        } else {
            $entity->setCustomer();
        }


        $this->assertEquals($entity->toArray(), [
            "supplier"     => $supplier,
            "business"     => $business,
            "name"         => $name,
            "nickname"     => $nickname,
            "email"        => $email,
            "mobile"       => $mobile,
            "whatsapp"     => $whatsapp,
            "phone"        => $phone,
            "nid"          => $nid,
            "ssn"          => $ssn,
            "zipcode"      => $zipcode,
            "street"       => $street,
            "streetNumber" => $streetNumber,
            "neighborhood" => $neighborhood,
            "city"         => $city,
            "state"        => $state
        ]);
    }
}

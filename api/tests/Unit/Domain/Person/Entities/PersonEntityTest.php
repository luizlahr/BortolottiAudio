<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Person\Entities;

use Borto\Domain\Person\Entities\AddressEntity;
use Borto\Domain\Person\Entities\PersonEntity;
use Tests\BaseTestCase;

class PersonEntityTest extends BaseTestCase
{
    public function testItCanCreateAPersonEntity(): void
    {
        $id = $this->randomId();
        $business = $this->faker->boolean;
        $supplier = $this->faker->boolean;
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

        $address = new AddressEntity(
            $zipcode,
            $street,
            $streetNumber,
            $neighborhood,
            $city,
            $state
        );


        $entity = new PersonEntity(
            $id,
            $supplier,
            $business,
            $name,
            $nickname,
            $email,
            $mobile,
            $whatsapp,
            $phone,
            $nid,
            $ssn,
            $address
        );

        $this->assertEquals($entity->getId(), $id);
        $this->assertEquals($entity->isBusiness(), $business);
        $this->assertEquals($entity->isSupplier(), $supplier);
        $this->assertEquals($entity->getName(), $name);
        $this->assertEquals($entity->getNickname(), $nickname);
        $this->assertEquals($entity->getEmail(), $email);
        $this->assertEquals($entity->getMobile(), $mobile);
        $this->assertEquals($entity->isWhatsapp(), $whatsapp);
        $this->assertEquals($entity->getPhone(), $phone);
        $this->assertEquals($entity->getNid(), $nid);
        $this->assertEquals($entity->getSsn(), $ssn);
        $this->assertEquals($entity->getAddress(), $address);
        $this->assertInstanceOf(AddressEntity::class, $entity->getAddress());
    }

    public function testItCanConvertAPersonEntityToArray(): void
    {
        $id = $this->randomId();
        $business = $this->faker->boolean;
        $supplier = $this->faker->boolean;
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

        $address = new AddressEntity(
            $zipcode,
            $street,
            $streetNumber,
            $neighborhood,
            $city,
            $state
        );

        $entity = new PersonEntity(
            $id,
            $supplier,
            $business,
            $name,
            $nickname,
            $email,
            $mobile,
            $whatsapp,
            $phone,
            $nid,
            $ssn,
            $address
        );

        $this->assertEquals($entity->toArray(), [
            "id"           => $id,
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

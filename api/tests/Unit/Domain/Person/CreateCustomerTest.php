<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Person;

use Borto\Domain\Person\CreateCustomer;
use Borto\Domain\Person\Entities\PersonEntity;
use Borto\Domain\Person\Entities\PersonRequestEntity;
use Borto\Domain\Person\Repositories\PersonRepository;
use Borto\Infrastructure\DB\Repositories\EloquentPersonRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class CreateCustomerTest extends BaseTestCase
{
    /** @var PersonRepository|MockObject $personRepository */
    private $personRepository;

    public function setup(): void
    {
        parent::setup();
        $this->personRepository = $this->createMock(EloquentPersonRepository::class);
    }

    public function testItCanCreateACustomer()
    {
        $person = $this->makePeople();
        $request = new PersonRequestEntity([
            "business"     => $this->faker->boolean,
            "name"         => $this->faker->name,
            "nickname"     => $this->faker->name,
            "email"        => $this->faker->email,
            "mobile"       => $this->fakerBR->cellphone,
            "whatsapp"     => $this->faker->boolean,
            "phone"        => $this->fakerBR->landline,
            "nid"          => $this->fakerBR->rg(false),
            "ssn"          => $this->fakerBR->cpf(false),
            "zipcode"      => $this->faker->postcode,
            "street"       => $this->faker->streetName,
            "streetNumber" => $this->faker->buildingNumber,
            "neighborhood" => $this->faker->city,
            "city"         => $this->faker->city,
            "state"        => $this->faker->stateAbbr,
        ]);

        $request->setCustomer();

        $this->personRepository->expects($this->once())
            ->method('createPerson')
            ->willReturn($person);

        $service = $this->getService();
        $response = $service->execute($request);
        $this->assertInstanceOf(PersonEntity::class, $response);
    }

    public function getService(): CreateCustomer
    {
        return new CreateCustomer($this->personRepository);
    }
}

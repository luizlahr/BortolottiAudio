<?php

declare(strict_types = 1);

namespace Tests\Integration\DB\Repositories;

use Borto\Domain\Person\Entities\PersonEntity;
use Borto\Domain\Person\Repositories\PersonRepository;
use Borto\Infrastructure\DB\Models\Person;
use Borto\Infrastructure\DB\Repositories\EloquentPersonRepository;
use Tests\TestCase;

class PersonRepositoryTest extends TestCase
{
    public function testItCanGetAPersonById()
    {
        $person = factory(Person::class)->create();
        $entity = $person->toEntity();

        $repository = $this->getRepository();
        $response = $repository->getById($person->id);

        $this->assertInstanceOf(PersonEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetAPersonByWrongId()
    {
        $person = factory(Person::class)->create(["supplier" => false]);
        $wrongId = $person->id + 1;

        $repository = $this->getRepository();
        $response = $repository->getById($wrongId);
        $this->assertEquals($response, null);
    }

    private function getRepository(): PersonRepository
    {
        $model = new Person();
        return new EloquentPersonRepository($model);
    }
}

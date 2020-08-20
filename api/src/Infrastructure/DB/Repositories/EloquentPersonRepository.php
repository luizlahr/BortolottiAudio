<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\DB\Repositories;

use Borto\Domain\Person\Entities\PersonCollection;
use Borto\Domain\Person\Entities\PersonEntity;
use Borto\Domain\Person\Entities\PersonRequestEntity;
use Borto\Domain\Person\Exceptions\CustomerNotFoundException;
use Borto\Domain\Person\Repositories\PersonRepository;
use Borto\Infrastructure\DB\Models\Person;
use Illuminate\Database\Eloquent\Collection;

class EloquentPersonRepository implements PersonRepository
{
    private Person $person;

    public function __construct()
    {
        $this->person = new Person();
    }

    public function getAll(): PersonCollection
    {
        $people = $this->person->orderBy('name')->get();
        return $this->makeCollection($people);
    }

    public function getById(int $id): ?PersonEntity
    {
        $person = $this->person->find($id);

        return Optional($person)->toEntity() ?? null;
    }

    public function createPerson(PersonRequestEntity $personData): PersonEntity
    {
        return $this->person->create($personData->toArray());
    }

    public function updatePerson(int $id, PersonRequestEntity $personData): PersonEntity
    {
        $person = $this->person->find($id);

        if (empty($person)) {
            throw new CustomerNotFoundException();
        }

        $person->update($personData->toArray());

        return $person->toEntity();
    }

    public function deletePerson(int $id): void
    {
        $person = $this->person->find($id);
        if (empty($person)) {
            throw new CustomerNotFoundException();
        }

        $person->delete();
    }

    /** @param Collection<Person> $people */
    public function makeCollection(Collection $people)
    {
        $personList = new PersonCollection();
        foreach ($people as $person) {
            $personList->add($person->toEntity());
        }
        return $personList;
    }
}

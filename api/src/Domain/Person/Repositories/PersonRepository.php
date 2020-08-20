<?php

declare(strict_types = 1);

namespace Borto\Domain\Person\Repositories;

use Borto\Domain\Person\Entities\PersonCollection;
use Borto\Domain\Person\Entities\PersonEntity;
use Borto\Domain\Person\Entities\PersonRequestEntity;

interface PersonRepository
{
    public function getAll(): PersonCollection;
    public function getById(int $id): ?PersonEntity;
    public function createPerson(PersonRequestEntity $personData): PersonEntity;
    public function updatePerson(int $id, PersonRequestEntity $personData): PersonEntity;
    public function deletePerson(int $id): void;
}

<?php

declare(strict_types = 1);

namespace Borto\Domain\Person;

use Borto\Domain\Person\Entities\PersonEntity;
use Borto\Domain\Person\Exceptions\CustomerNotFoundException;
use Borto\Domain\Person\Repositories\PersonRepository;

class ReadCustomer
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function execute(int $id): PersonEntity
    {
        $person = $this->personRepository->getById($id);

        if (empty($person) || $person->isSupplier()) {
            throw new CustomerNotFoundException();
        }

        return $person;
    }
}

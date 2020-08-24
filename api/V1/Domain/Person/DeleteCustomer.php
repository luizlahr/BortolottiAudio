<?php

declare(strict_types = 1);

namespace Borto\Domain\Person;

use Borto\Domain\Person\Exceptions\CustomerNotFoundException;
use Borto\Domain\Person\Repositories\PersonRepository;

class DeleteCustomer
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function execute(int $id): void
    {
        $person = $this->personRepository->getById($id);

        if (empty($person) || $person->isSupplier()) {
            throw new CustomerNotFoundException();
        }

        $this->personRepository->deletePerson($id);
    }
}

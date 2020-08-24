<?php

declare(strict_types = 1);

namespace Borto\Domain\Person;

use Borto\Domain\Person\Entities\PersonEntity;
use Borto\Domain\Person\Entities\PersonRequestEntity;
use Borto\Domain\Person\Exceptions\SupplierNotFoundException;
use Borto\Domain\Person\Repositories\PersonRepository;

class UpdateSupplier
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function execute(int $id, PersonRequestEntity $request): PersonEntity
    {
        $person = $this->personRepository->getById($id);

        if (empty($person) || $person->isSupplier() !== $request->isSupplier()) {
            throw new SupplierNotFoundException();
        }

        return $this->personRepository->updatePerson($id, $request);
    }
}

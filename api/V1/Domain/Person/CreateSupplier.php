<?php

declare(strict_types = 1);

namespace Borto\Domain\Person;

use Borto\Domain\Person\Entities\PersonEntity;
use Borto\Domain\Person\Entities\PersonRequestEntity;
use Borto\Domain\Person\Repositories\PersonRepository;

class CreateSupplier
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function execute(PersonRequestEntity $request): PersonEntity
    {
        $request->setSupplier();
        return $this->personRepository->createPerson($request);
    }
}

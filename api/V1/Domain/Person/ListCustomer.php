<?php

declare(strict_types = 1);

namespace Borto\Domain\Person;

use Borto\Domain\Person\Entities\PersonCollection;
use Borto\Domain\Person\Repositories\PersonRepository;

class ListCustomer
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function execute(): PersonCollection
    {
        return $this->personRepository->filter(["supplier" => false]);
    }
}

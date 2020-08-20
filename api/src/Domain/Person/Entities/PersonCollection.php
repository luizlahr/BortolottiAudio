<?php

declare(strict_types = 1);

namespace Borto\Domain\Person\Entities;

use ArrayObject;

class PersonCollection extends ArrayObject
{
    public function add(PersonEntity $brand): void
    {
        $this->append($brand);
    }

    /** @param array<PersonEntity> $people */
    public function fill(array $people): void
    {
        foreach ($people as $person) {
            $this->append($person);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($brand) {
            return $brand->toArray();
        }, $this->getArrayCopy());
    }
}

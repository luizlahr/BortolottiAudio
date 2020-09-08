<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Entities;

use ArrayObject;

class InformationCollection extends ArrayObject
{
    public function add(InformationEntity $information): void
    {
        $this->append($information);
    }

    /** @param array<InformationEntity> $items */
    public function fill(array $informations): void
    {
        foreach ($informations as $information) {
            $this->append($information);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($information) {
            return $information->toArray();
        }, $this->getArrayCopy());
    }
}

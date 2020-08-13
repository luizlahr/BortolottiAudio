<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

use ArrayObject;

class BrandCollection extends ArrayObject
{
    public function add(BrandEntity $brand): void
    {
        $this->append($brand);
    }

    /** @param array<BrandEntity> $brands */
    public function fill(array $brands): void
    {
        foreach ($brands as $brand) {
            $this->append($brand);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($brand) {
            return $brand->toArray();
        }, $this->getArrayCopy());
    }
}

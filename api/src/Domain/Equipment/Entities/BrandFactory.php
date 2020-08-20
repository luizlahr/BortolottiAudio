<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

class BrandFactory
{
    public function make(
        int $id,
        string $name
    ): BrandEntity {
        return new BrandEntity(
            $id,
            $name
        );
    }
}

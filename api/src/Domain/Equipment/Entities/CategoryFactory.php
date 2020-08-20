<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

class CategoryFactory
{
    public function make(
        int $id,
        string $name
    ): CategoryEntity {
        return new CategoryEntity(
            $id,
            $name
        );
    }
}

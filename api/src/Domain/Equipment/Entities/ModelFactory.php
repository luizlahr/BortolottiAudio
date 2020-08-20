<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

class ModelFactory
{
    public function make(
        int $id,
        int $categoryId,
        int $brandId,
        string $name,
        ?CategoryEntity $category = null,
        ?BrandEntity $brand = null
    ): ModelEntity {
        return new ModelEntity(
            $id,
            $categoryId,
            $brandId,
            $name,
            $category,
            $brand
        );
    }
}

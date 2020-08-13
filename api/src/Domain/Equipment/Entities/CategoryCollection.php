<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

use ArrayObject;

class CategoryCollection extends ArrayObject
{
    public function add(CategoryEntity $category): void
    {
        $this->append($category);
    }

    /** @param array<CategoryEntity> $categories */
    public function fill(array $categories): void
    {
        foreach ($categories as $category) {
            $this->append($category);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($category) {
            return $category->toArray();
        }, $this->getArrayCopy());
    }
}

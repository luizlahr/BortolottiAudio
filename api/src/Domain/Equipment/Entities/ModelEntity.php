<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

class ModelEntity
{
    private int $categoryId;
    private int $brandId;
    private string $name;

    public function __construct(
        int $categoryId,
        int $brandId,
        string $name
    ) {
        $this->categoryId = $categoryId;
        $this->brandId = $brandId;
        $this->name = $name;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            "category_id" => $this->categoryId,
            "brand_id"    => $this->brandId,
            "name"        => $this->name,
        ];
    }
}

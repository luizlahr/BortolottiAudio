<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

class ModelRequestEntity
{
    private int $categoryId;
    private int $brandId;
    private string $name;

    public function __construct(array $requestData)
    {
        $this->name = $requestData["name"];
        $this->categoryId = $requestData["category_id"];
        $this->brandId = $requestData["brand_id"];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function toArray()
    {
        return [
            "category_id" => $this->categoryId,
            "brand_id"    => $this->brandId,
            "name"        => $this->name,
        ];
    }
}

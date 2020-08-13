<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

class CategoryRequestEntity
{
    private string $name;

    public function __construct(array $requestData)
    {
        $this->name = $requestData["name"];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray()
    {
        return [
            "name" => $this->name
        ];
    }
}

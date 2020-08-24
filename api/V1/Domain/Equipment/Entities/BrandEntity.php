<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

class BrandEntity
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            "id"   => $this->id,
            "name" => $this->name
        ];
    }
}

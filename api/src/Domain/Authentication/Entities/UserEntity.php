<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication\Entities;

class UserEntity
{
    private ?int $id;
    private string $name;
    private string $email;
    private ?string $password;
    private bool $active;

    public function __construct(
        ?int $id,
        string $name,
        string $email,
        ?string $password,
        bool $active
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->active = $active;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function toArray(): array
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "active"=>$this->active,
        ];
    }
}

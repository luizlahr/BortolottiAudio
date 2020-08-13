<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication\Entities;

class UserRequestEntity
{
    private ?string $name;
    private ?string $email;
    private ?string $password;
    private ?bool $active;

    public function __construct(
        array $requestData
    ) {
        $this->name = $requestData["name"] ?? null;
        $this->email = $requestData["email"] ?? null;
        $this->password = $requestData["password"] ?? null;
        $this->active = $requestData["active"] ?? null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function toArray(): array
    {
        return [
            "name"     => $this->name,
            "email"    => $this->email,
            "password" => $this->password,
            "active"   => $this->active,
        ];
    }
}

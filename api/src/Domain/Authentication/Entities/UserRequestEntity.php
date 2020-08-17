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
        $this->name = optional($requestData)["name"];
        $this->email = optional($requestData)["email"];
        $this->password = optional($requestData)["password"];
        $this->active = optional($requestData)["active"];
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

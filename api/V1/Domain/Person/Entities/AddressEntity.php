<?php

declare(strict_types = 1);

namespace Borto\Domain\Person\Entities;

class AddressEntity
{
    private ?string $zipcode;
    private ?string $street;
    private ?string $streetNumber;
    private ?string $neighborhood;
    private ?string $city;
    private ?string $state;

    public function __construct(
        ?string $zipcode,
        ?string $street,
        ?string $streetNumber,
        ?string $neighborhood,
        ?string $city,
        ?string $state
    ) {
        $this->zipcode = $zipcode;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->state = $state;
    }

    public function getZipcode() : ?string
    {
        return $this->zipcode;
    }

    public function getStreet() : ?string
    {
        return $this->street;
    }

    public function getStreetNumber() : ?string
    {
        return $this->streetNumber;
    }

    public function getNeighborhood() : ?string
    {
        return $this->neighborhood;
    }

    public function getCity() : ?string
    {
        return $this->city;
    }

    public function getState() : ?string
    {
        return $this->state;
    }

    public function toArray(): array
    {
        return [
            "zipcode"      => $this->zipcode,
            "street"       => $this->street,
            "streetNumber" => $this->streetNumber,
            "neighborhood" => $this->neighborhood,
            "city"         => $this->city,
            "state"        => $this->state
        ];
    }
}

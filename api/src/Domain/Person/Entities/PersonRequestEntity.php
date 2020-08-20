<?php

declare(strict_types = 1);

namespace Borto\Domain\Person\Entities;

class PersonRequestEntity
{
    private bool $supplier;
    private bool $business;
    private string $name;
    private ?string $nickname;
    private ?string $email;
    private ?string $mobile;
    private bool $whatsapp;
    private ?string $phone;
    private ?string $nid;
    private ?string $ssn;
    private ?string $zipcode;
    private ?string $street;
    private ?string $streetNumber;
    private ?string $neighborhood;
    private ?string $city;
    private ?string $state;

    public function __construct(array $requestData)
    {
        $this->business = $requestData["business"];
        $this->name = $requestData["name"];
        $this->nickname = $requestData["nickname"];
        $this->email = $requestData["email"];
        $this->mobile = $requestData["mobile"];
        $this->whatsapp = $requestData["whatsapp"];
        $this->phone = $requestData["phone"];
        $this->nid = $requestData["nid"];
        $this->ssn = $requestData["ssn"];
        $this->zipcode = $requestData["zipcode"];
        $this->street = $requestData["street"];
        $this->streetNumber = $requestData["streetNumber"];
        $this->neighborhood = $requestData["neighborhood"];
        $this->city = $requestData["city"];
        $this->state = $requestData["state"];
    }

    public function setSupplier(): void
    {
        $this->supplier = true;
    }

    public function setCustomer(): void
    {
        $this->supplier = false;
    }

    public function isSupplier(): bool
    {
        return $this->supplier;
    }

    public function isBusiness(): bool
    {
        return $this->business;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function isWhatsapp(): bool
    {
        return !!$this->whatsapp;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getNid(): ?string
    {
        return $this->nid;
    }

    public function getSsn(): ?string
    {
        return $this->ssn;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getState(): ?string
    {
        return $this->state;
    }


    public function toArray()
    {
        return [
            "supplier"     => $this->supplier,
            "business"     => $this->business,
            "name"         => $this->name,
            "nickname"     => $this->nickname,
            "email"        => $this->email,
            "mobile"       => $this->mobile,
            "whatsapp"     => $this->whatsapp,
            "phone"        => $this->phone,
            "nid"          => $this->nid,
            "ssn"          => $this->ssn,
            "zipcode"      => $this->zipcode,
            "street"       => $this->street,
            "streetNumber" => $this->streetNumber,
            "neighborhood" => $this->neighborhood,
            "city"         => $this->city,
            "state"        => $this->state,
        ];
    }
}

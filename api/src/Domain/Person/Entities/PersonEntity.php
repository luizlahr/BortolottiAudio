<?php

declare(strict_types = 1);

namespace Borto\Domain\Person\Entities;

class PersonEntity
{
    private int $id;
    private bool $business;
    private bool $supplier;
    private string $name;
    private ?string $nickname;
    private ?string $email;
    private ?string $mobile;
    private bool $whatsapp;
    private ?string $phone;
    private ?string $nid;
    private ?string $ssn;
    private AddressEntity $address;

    public function __construct(
        int $id,
        bool $business,
        bool $supplier,
        string $name,
        ?string $nickname,
        ?string $email,
        ?string $mobile,
        ?bool $whatsapp,
        ?string $phone,
        ?string $nid,
        ?string $ssn,
        AddressEntity $address
    ) {
        $this->id = $id;
        $this->business = $business;
        $this->supplier = $supplier;
        $this->name = $name;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->whatsapp = $whatsapp;
        $this->phone = $phone;
        $this->nid = $nid;
        $this->ssn = $ssn;
        $this->address = $address;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function isBusiness(): bool
    {
        return $this->business;
    }

    public function isSupplier(): bool
    {
        return $this->supplier;
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

    public function getAddress(): AddressEntity
    {
        return $this->address;
    }

    public function toArray()
    {
        return [
            "id"       => $this->id,
            "business" => $this->business,
            "supplier" => $this->supplier,
            "name"     => $this->name,
            "nickname" => $this->nickname,
            "email"    => $this->email,
            "mobile"   => $this->mobile,
            "whatsapp" => $this->whatsapp,
            "phone"    => $this->phone,
            "nid"      => $this->nid,
            "ssn"      => $this->ssn,
            "address"  => $this->address->toArray()
        ];
    }
}

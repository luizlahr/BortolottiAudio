<?php

namespace  Borto\Infrastructure\DB\Models;

use Borto\Domain\Person\Entities\AddressEntity;
use Borto\Domain\Person\Entities\PersonEntity;
use Illuminate\Database\Eloquent\Model as DBModel;

class Person extends DBModel
{
    protected $table = "people";

    protected $fillable = [
        'name','business','supplier','name','nickname','email',
        'mobile','whatsapp','phone','nid','ssn','zipcode','street',
        'streetNumber','neighborhood','city','state'
    ];

    public function toEntity(): PersonEntity
    {
        $address = new AddressEntity(
            $this->zipcode,
            $this->street,
            $this->streetNumber,
            $this->neighborhood,
            $this->city,
            $this->state
        );

        return new PersonEntity(
            $this->id,
            $this->business,
            $this->supplier,
            $this->name,
            $this->nickname,
            $this->email,
            $this->mobile,
            $this->whatsapp,
            $this->phone,
            $this->nid,
            $this->ssn,
            $address
        );
    }
}

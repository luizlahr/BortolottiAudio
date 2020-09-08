<?php

declare(strict_types = 1);

namespace Borto\Domain\Person\Entities;

class PersonFactory
{
    public function createFromArray(array $data): PersonEntity
    {
        $addressEntity = new AddressEntity(
            $data["zipcode"],
            $data["street"],
            $data["streetNumber"],
            $data["neighborhood"],
            $data["city"],
            $data["state"]
        );

        return new PersonEntity(
            $data["id"],
            $data["supplier"],
            $data["business"],
            $data["name"],
            $data["nickname"],
            $data["email"],
            $data["mobile"],
            $data["whatsapp"],
            $data["phone"],
            $data["nid"],
            $data["ssn"],
            $addressEntity
        );
    }
}

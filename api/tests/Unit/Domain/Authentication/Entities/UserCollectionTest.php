<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Entities;

use Borto\Domain\Authentication\Entities\UserCollection;
use Borto\Domain\Authentication\Entities\UserEntity;
use Tests\BaseTestCase;

class UserCollectionTest extends BaseTestCase
{
    public function testItCanAddToUserCollection(): void
    {
        $entity = $this->makeUsers();

        $collection = new UserCollection();

        $collection->add($entity);
        $this->assertCount(1, $collection);
    }

    public function testItCanFillUserCollection(): void
    {
        $amount = $this->faker->numberBetween(2, 10);
        $entities = $this->makeUsers($amount, true);

        $collection = new UserCollection();

        $collection->fill($entities);
        $this->assertCount($amount, $collection);
    }

    public function testItCanConvertserCollectionToArray(): void
    {
        $id = $this->randomId();
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $active = $this->faker->boolean;

        $entity = new UserEntity(
            $id,
            $name,
            $email,
            $password,
            $active,
        );

        $collection = new UserCollection();
        $collection->add($entity);

        $this->assertEquals($collection->toArray(), [[
            "id"     => $id,
            "name"   => $name,
            "email"  => $email,
            "active" => $active,
        ]]);
    }
}

<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Entities;

use Tests\BaseTestCase;
use Borto\Domain\Authentication\Entities\UserEntity;

class UserEntityTest extends BaseTestCase
{
    public function testItCanCreateUserEntity(): void
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

        $this->assertEquals($entity->getId(), $id);
        $this->assertEquals($entity->getName(), $name);
        $this->assertEquals($entity->getEmail(), $email);
        $this->assertEquals($entity->getPassword(), $password);
        $this->assertEquals($entity->isActive(), $active);
    }

    public function testItCanConvertUserEntityToArray(): void
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

        $this->assertEquals($entity->toArray(), [
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "active" => $active,
        ]);
    }
}

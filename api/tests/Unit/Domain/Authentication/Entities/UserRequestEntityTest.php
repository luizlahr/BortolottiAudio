<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Entities;

use Borto\Domain\Authentication\Entities\UserRequestEntity;
use Tests\BaseTestCase;

class UserRequestEntityTest extends BaseTestCase
{
    public function testItCanCreateUserRequestEntity(): void
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $active = $this->faker->boolean;

        $entity = new UserRequestEntity([
            "name"     => $name,
            "email"    => $email,
            "password" => $password,
            "active"   => $active,
        ]);

        $this->assertEquals($entity->getName(), $name);
        $this->assertEquals($entity->getEmail(), $email);
        $this->assertEquals($entity->getPassword(), $password);
        $this->assertEquals($entity->isActive(), $active);
    }

    public function testItCanConvertUserRequestEntityToArray(): void
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $active = $this->faker->boolean;

        $entity = new UserRequestEntity([
            "name"     => $name,
            "email"    => $email,
            "password" => $password,
            "active"   => $active,
        ]);

        $this->assertEquals($entity->toArray(), [
            "name"     => $name,
            "email"    => $email,
            "password" => $password,
            "active"   => $active,
        ]);
    }
}

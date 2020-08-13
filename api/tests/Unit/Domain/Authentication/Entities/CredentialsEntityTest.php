<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Entities;

use Borto\Domain\Authentication\Entities\CredentialsEntity;
use Tests\BaseTestCase;

class CredentialsEntityTest extends BaseTestCase
{
    public function testItCanCreateUserEntity(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;

        $entity = new CredentialsEntity(
            $email,
            $password,
        );

        $this->assertEquals($entity->getEmail(), $email);
        $this->assertEquals($entity->getPassword(), $password);
    }
}

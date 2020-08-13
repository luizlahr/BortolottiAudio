<?php

declare(strict_types = 1);

namespace Tests\Integration\Services;

use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Domain\Shared\Services\AuthInfo;
use Borto\Infrastructure\DB\Models\User;
use Borto\Infrastructure\Services\IlluminateAuthInfo;
use Tests\TestCase;

class AuthInfoTest extends TestCase
{
    public function testItCanGetLoggedUser()
    {
        $user = factory(User::class)->create();
        $entity = new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            null,
            $user->active,
        );
        $this->be($user);

        $auth = $this->getAuthInfo();
        $response = $auth->getUser();

        $this->assertEquals($entity, $response);
    }

    public function testItReturnsNullIfTheUserIsNotLoggedIn()
    {
        $auth = $this->getAuthInfo();
        $response = $auth->getUser();

        $this->assertEquals(null, $response);
    }

    public function getAuthInfo(): AuthInfo
    {
        return new IlluminateAuthInfo();
    }
}

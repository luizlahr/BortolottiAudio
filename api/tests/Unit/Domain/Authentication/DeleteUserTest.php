<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Borto\Domain\Authentication\DeleteUser;
use Borto\Domain\Authentication\Entities\UserRequestEntity;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Shared\Exceptions\NotAllowedException;
use Borto\Domain\Shared\Services\AuthInfo;
use Borto\Infrastructure\DB\Repositories\EloquentUserRepository;
use Borto\Infrastructure\Services\IlluminateAuthInfo;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class DeleteUserTest extends BaseTestCase
{
    /** @var UserRepository|MockObject $userRepository */
    private $userRepository;

    /** @var AuthInfo|MockObject $userRepository */
    private $authInfo;

    public function setup(): void
    {
        parent::setup();

        $this->userRepository = $this->createMock(EloquentUserRepository::class);
        $this->authInfo = $this->createMock(IlluminateAuthInfo::class);
    }

    public function testItCanDeleteAnUser()
    {
        $authUser = $this->makeUsers();
        $user = $this->makeUsers();

        $this->userRepository->expects($this->once())
            ->method('getById')
            ->willReturn($user);

        $this->authInfo->expects($this->once())
            ->method('getUser')
            ->willReturn($authUser);

        $this->userRepository->expects($this->once())
            ->method('deleteUser');

        $service = $this->getService();
        $service->handle($user->getId());
    }

    public function testItCanDeleteSelf()
    {
        $user = $this->makeUsers();

        $this->userRepository->expects($this->once())
            ->method('getById')
            ->willReturn($user);

        $this->authInfo->expects($this->once())
            ->method('getUser')
            ->willReturn($user);

        $service = $this->getService();
        $this->expectException(NotAllowedException::class);
        $service->handle($user->getId());
    }

    public function testItCanNotDeleteAnUnexistingUser()
    {
        $authUser = $this->makeUsers();
        $wrongId = $authUser->getId() + 1;

        $this->userRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $service = $this->getService();
        $this->expectException(UserNotFoundException::class);
        $service->handle($wrongId);
    }

    public function testItCanNotUpdateUnexistingUser()
    {
        $id = $this->randomId();
        $user = $this->makeUsers();
        $userRequest = new UserRequestEntity([
            "name"     => $user->getName(),
            "email"    => $user->getEmail(),
            "password" => $user->getPassword(),
            "active"   => $user->isActive()
        ]);

        $this->userRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $service = $this->getService();
        $this->expectException(UserNotFoundException::class);
        $service->handle($id, $userRequest);
    }

    public function getService(): DeleteUser
    {
        return new DeleteUser($this->userRepository, $this->authInfo);
    }
}

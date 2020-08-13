<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Borto\Domain\Authentication\Entities\UserRequestEntity;
use Borto\Domain\Authentication\Exceptions\DuplicatedUserEmailException;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Authentication\UpdateUser;
use Borto\Infrastructure\DB\Repositories\EloquentUserRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class UpdateUserTest extends BaseTestCase
{
    /** @var UserRepository|MockObject $userRepository */
    private $userRepository;

    public function setup(): void
    {
        parent::setup();

        $this->userRepository = $this->createMock(EloquentUserRepository::class);
    }

    public function testItCanUpdateAnUser()
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
            ->willReturn($user);

        $this->userRepository->expects($this->once())
            ->method('updateUser')
            ->willReturn($user);

        $service = $this->getService();
        $response = $service->handle($id, $userRequest);

        $this->assertEquals($response, $user);
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

    public function testItCanNotUpdateUserWithDuplicatedEmail()
    {
        $email = $this->faker->email;
        $user = $this->makeUsers();
        $existingUser = $this->makeUsers(1, false, ["email" => $email]);
        $userRequest = new UserRequestEntity([
            "name"     => $user->getName(),
            "email"    => $email,
            "password" => $user->getPassword(),
            "active"   => $user->isActive()
        ]);

        $this->userRepository->expects($this->once())
            ->method('getById')
            ->willReturn($user);

        $this->userRepository->expects($this->once())
            ->method('getByEmail')
            ->willReturn($existingUser);

        $service = $this->getService();
        $this->expectException(DuplicatedUserEmailException::class);
        $service->handle($user->getId(), $userRequest);
    }

    public function getService(): UpdateUser
    {
        return new UpdateUser($this->userRepository);
    }
}

<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Tests\BaseTestCase;
use Borto\Domain\Shared\Services\HashMaker;
use PHPUnit\Framework\MockObject\MockObject;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Authentication\CreateUser;
use Borto\Infrastructure\Services\IlluminateHashMaker;
use Borto\Domain\Authentication\Entities\UserRequestEntity;
use Borto\Domain\Authentication\Exceptions\DuplicatedUserEmailException;
use Borto\Infrastructure\DB\Repositories\EloquentUserRepository;

class CreateUserTest extends BaseTestCase
{
    /** @var UserRepository|MockObject $userRepository */
    private $userRepository;

    /** @var HashMaker|MockObject $hashMaker */
    private $hashMaker;

    public function setup(): void
    {
        parent::setup();

        $this->userRepository = $this->createMock(EloquentUserRepository::class);
        $this->hashMaker = $this->createMock(IlluminateHashMaker::class);
    }

    public function testItCanCreateAnUser()
    {
        $user = $this->makeUsers();
        $userRequest = new UserRequestEntity([
            "name"=>$user->getName(),
            "email"=>$user->getEmail(),
            "password"=>$user->getPassword(),
            "active"=>$user->isActive()
        ]);
        $password = $this->randomPassword(10);

        $this->userRepository->expects($this->once())
            ->method('getByEmail')
            ->willReturn(null);

        $this->hashMaker->expects($this->once())
            ->method('make')
            ->willReturn($password);

        $this->userRepository->expects($this->once())
            ->method('createUser')
            ->willReturn($user);

        $service = $this->getService();
        $response = $service->handle($userRequest);

        $this->assertEquals($response, $user);
    }

    public function testItCanNotCreateAnUserWithDuplicatedEmail()
    {
        $user = $this->makeUsers();
        $existingUser = $this->makeUsers();
        $userRequest = new UserRequestEntity([
            "name"=>$user->getName(),
            "email"=>$user->getEmail(),
            "password"=>$user->getPassword(),
            "active"=>$user->isActive()
        ]);

        $this->userRepository->expects($this->once())
            ->method('getByEmail')
            ->willReturn($existingUser);

        $service = $this->getService();

        $this->expectException(DuplicatedUserEmailException::class);
        $service->handle($userRequest);
    }

    public function getService(): CreateUser
    {
        return new CreateUser($this->userRepository, $this->hashMaker);
    }
}

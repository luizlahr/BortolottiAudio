<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Tests\BaseTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Shared\Services\HashChecker;
use Borto\Domain\Authentication\AuthenticateUser;
use Borto\Infrastructure\Services\IlluminateHashChecker;
use Borto\Domain\Authentication\Entities\CredentialsEntity;
use Borto\Domain\Authentication\Exceptions\InvalidCredentialsException;
use Borto\Infrastructure\DB\Repositories\EloquentUserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthenticateUserTest extends BaseTestCase
{
    /** @var UserRepository|MockObject $userRepository */
    private $userRepository;

    /** @var HashChecker|MockObject $hashChecker */
    private $hashChecker;

    public function setup(): void
    {
        parent::setup();

        $this->userRepository = $this->createMock(EloquentUserRepository::class);
        $this->hashChecker = $this->createMock(IlluminateHashChecker::class);
    }

    public function testItCanAuthenticateAUserWithWrightCredentials()
    {
        $user = $this->makeUsers();
        $credentials = new CredentialsEntity($user->getEmail(), $user->getPassword());
        $token = $this->randomToken();

        $this->userRepository->expects($this->once())
            ->method('getByEmail')
            ->willReturn($user);

        $this->hashChecker->expects($this->once())
            ->method('check')
            ->willReturn(true);

        $this->userRepository->expects($this->once())
            ->method('createAuthToken')
            ->willReturn($token);

        $service = $this->getService();
        $response = $service->authenticate($credentials);

        $this->assertEquals($response["user"], $user->toArray());
        $this->assertEquals($response["token"], $token);
    }

    public function testItCanNotAuthenticateAUserWithWrongEmail()
    {
        $user = $this->makeUsers();
        $wrongEmail = "wrong-". $this->faker->email;
        $credentials = new CredentialsEntity($wrongEmail, $user->getPassword());
        $token = $this->randomToken();

        $this->userRepository->expects($this->once())
            ->method('getByEmail')
            ->willReturn(null);

        $service = $this->getService();
        $this->expectException(InvalidCredentialsException::class);
        $service->authenticate($credentials);
    }

    public function testItCanNotAuthenticateAUserWithWrongPassword()
    {
        $user = $this->makeUsers();
        $wrongPassword = "wrong-" . $user->getPassword();
        $credentials = new CredentialsEntity($user->getEmail(), $wrongPassword);

        $this->userRepository->expects($this->once())
            ->method('getByEmail')
            ->willReturn($user);

        $this->hashChecker->expects($this->once())
            ->method('check')
            ->willReturn(false);

        $service = $this->getService();
        $this->expectException(InvalidCredentialsException::class);
        $service->authenticate($credentials);
    }

    public function getService(): AuthenticateUser
    {
        return new AuthenticateUser($this->userRepository, $this->hashChecker);
    }
}

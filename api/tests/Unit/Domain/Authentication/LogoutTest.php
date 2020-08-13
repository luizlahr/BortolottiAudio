<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Borto\Domain\Authentication\Logout;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Shared\Services\AuthInfo;
use Borto\Infrastructure\DB\Repositories\EloquentUserRepository;
use Borto\Infrastructure\Services\IlluminateAuthInfo;
use Illuminate\Validation\UnauthorizedException;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class LogoutTest extends BaseTestCase
{
    /** @var UserRepository|MockObject $userRepository */
    private $userRepository;

    /** @var AuthInfo|MockObject $authInfo */
    private $authInfo;

    public function setup(): void
    {
        parent::setup();

        $this->userRepository = $this->createMock(EloquentUserRepository::class);
        $this->authInfo = $this->createMock(IlluminateAuthInfo::class);
    }

    public function testItCanLogoutAnUserAlreadyLoggedIn()
    {
        $user = $this->makeUsers();
        $token = $this->randomToken();

        $this->authInfo->expects($this->once())
            ->method('getUser')
            ->willReturn($user);

        $this->userRepository->expects($this->once())
            ->method('deleteAuthTokens');

        $service = $this->getService();
        $service->handle();
    }

    public function testItCanNotLogoutAnUserThatIsNotLoggedIn()
    {
        $this->authInfo->expects($this->once())
            ->method('getUser')
            ->willThrowException(new UnauthorizedException());


        $service = $this->getService();
        $this->expectException(UnauthorizedException::class);
        $service->handle();
    }

    public function getService(): Logout
    {
        return new Logout($this->userRepository, $this->authInfo);
    }
}

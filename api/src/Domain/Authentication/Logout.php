<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication;

use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Shared\Services\AuthInfo;

class Logout
{
    private UserRepository $userRepository;
    private AuthInfo $auth;

    public function __construct(UserRepository $userRepository, AuthInfo $auth)
    {
        $this->userRepository = $userRepository;
        $this->auth = $auth;
    }

    public function handle(): void
    {
        $user = $this->auth->getUser();
        $this->userRepository->deleteAuthTokens($user->getId());
    }
}

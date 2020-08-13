<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication;

use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Shared\Exceptions\NotAllowedException;
use Borto\Domain\Shared\Services\AuthInfo;

class DeleteUser
{
    private UserRepository $userRepository;
    private AuthInfo $auth;

    public function __construct(UserRepository $userRepository, AuthInfo $auth)
    {
        $this->userRepository = $userRepository;
        $this->auth = $auth;
    }

    public function handle(int $id): void
    {
        $user = $this->userRepository->getById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $currentUser = $this->auth->getUser();

        if ($user->getId() === $currentUser->getId()) {
            throw new NotAllowedException();
        }

        $this->userRepository->deleteUser($id);
    }
}

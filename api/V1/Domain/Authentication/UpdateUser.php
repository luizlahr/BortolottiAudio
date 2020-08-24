<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication;

use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Domain\Authentication\Entities\UserRequestEntity;
use Borto\Domain\Authentication\Exceptions\DuplicatedUserEmailException;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Repositories\UserRepository;

class UpdateUser
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(int $id, UserRequestEntity $userData): UserEntity
    {
        $user = $this->userRepository->getById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if ($userData->getEmail() && $this->userRepository->getByEmail($userData->getEmail())) {
            throw new DuplicatedUserEmailException();
        }

        return $this->userRepository->updateUser($id, $userData->toArray());
    }
}

<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication;

use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Domain\Authentication\Entities\UserRequestEntity;
use Borto\Domain\Authentication\Exceptions\DuplicatedUserEmailException;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Shared\Services\HashMaker;

class CreateUser
{
    private UserRepository $userRepository;
    private HashMaker $hashMaker;

    public function __construct(UserRepository $userRepository, HashMaker $hashMaker)
    {
        $this->userRepository = $userRepository;
        $this->hashMaker = $hashMaker;
    }

    public function handle(UserRequestEntity $userData): UserEntity
    {
        $user = $this->userRepository->getByEmail($userData->getEmail());

        if (!empty($user)) {
            throw new DuplicatedUserEmailException();
        }

        $userArray = $userData->toArray();
        $userArray["password"] = $this->hashMaker->make($userArray["password"]);

        return $this->userRepository->createUser($userArray);
    }
}

<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication;

use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Shared\Services\HashChecker;
use Borto\Domain\Authentication\Entities\CredentialsEntity;
use Borto\Domain\Authentication\Exceptions\InvalidCredentialsException;

class AuthenticateUser
{
    private UserRepository $userRepository;
    private HashChecker $hashChecker;

    public function __construct(UserRepository $userRepository, HashChecker $hashChecker)
    {
        $this->userRepository = $userRepository;
        $this->hashChecker = $hashChecker;
    }

    public function authenticate(CredentialsEntity $credentials)
    {
        $user = $this->userRepository->getByEmail($credentials->getEmail());

        if (!$user || !$this->hashChecker->check($credentials->getPassword(), $user->getPassword())) {
            throw new InvalidCredentialsException();
        }

        $token = $this->userRepository->createAuthToken($user->getId());

        return [
            "user" => $user->toArray(),
            "token" => $token
        ];
    }
}

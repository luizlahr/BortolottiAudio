<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication\Repositories;

use Borto\Domain\Authentication\Entities\UserCollection;
use Borto\Domain\Authentication\Entities\UserEntity;

interface UserRepository
{
    public function getAll(): UserCollection;
    public function getById(int $id): ?UserEntity;
    public function getByEmail(string $email): ?UserEntity;
    public function createUser(array $userData): UserEntity;
    public function updateUser(int $id, array $userData): UserEntity;
    public function deleteUser(int $id): void;
    public function createAuthToken(int $userId): string;
    public function deleteAuthTokens(int $userId): void;
}

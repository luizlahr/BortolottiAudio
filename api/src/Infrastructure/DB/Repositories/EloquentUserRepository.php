<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\DB\Repositories;

use Borto\Domain\Authentication\Entities\UserCollection;
use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Infrastructure\DB\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepository
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getAll(): UserCollection
    {
        $users = $this->user->orderBy('name', 'asc')->get();
        return $this->makeCollection($users);
    }

    public function getById(int $id): ?UserEntity
    {
        $user = $this->user->find($id);

        return $this->makeEntity($user);
    }

    public function getByEmail(string $email): ?UserEntity
    {
        $user = $this->user->where('email', $email)->first();

        return $this->makeEntity($user);
    }

    public function createUser(array $userData): UserEntity
    {
        $user = $this->user->create($userData);
        return $this->makeEntity($user);
    }

    public function updateUser(int $id, array $userData): UserEntity
    {
        $user = $this->user->find($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        foreach ($userData as $field => $value) {
            if ($value === null) {
                unset($userData[$field]);
            }
        }

        $user->update($userData);
        return $this->makeEntity($user);
    }

    public function deleteUser(int $id): void
    {
        $user = $this->user->find($id);

        //TODO: add rule to prevent users to delete theirselfs

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->delete();
    }

    public function createAuthToken(int $userId): string
    {
        $user = $this->user->find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->tokens()->delete();

        return $user->createToken('user-token', ['admin:full'])->plainTextToken;
    }

    public function deleteAuthTokens(int $userId): void
    {
        $user = $this->user->find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->tokens()->delete();
    }

    /** @param Collection<User> $users */
    public function makeCollection(Collection $users)
    {
        $userList = new UserCollection();
        foreach ($users as $user) {
            $userList->add($this->makeEntity($user));
        }
        return $userList;
    }

    public function makeEntity(?User $user): ?UserEntity
    {
        if (!$user) {
            return null;
        }

        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $user->active
        );
    }
}

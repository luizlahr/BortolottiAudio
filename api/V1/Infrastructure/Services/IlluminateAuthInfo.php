<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\Services;

use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Domain\Shared\Services\AuthInfo;
use Borto\Infrastructure\DB\Models\User;

class IlluminateAuthInfo implements AuthInfo
{
    public function getUser(): ?UserEntity
    {
        $user = auth()->user();
        return $this->makeEntity($user);
    }

    private function makeEntity(?User $user): ?UserEntity
    {
        if (!$user) {
            return null;
        }

        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            null,
            $user->active
        );
    }
}

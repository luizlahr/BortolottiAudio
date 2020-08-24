<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication\Entities;

use ArrayObject;

class UserCollection extends ArrayObject
{
    public function add(UserEntity $user): void
    {
        $this->append($user);
    }

    /** @param array<UserEntity> $users */
    public function fill(array $users): void
    {
        foreach ($users as $user) {
            $this->append($user);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($user) {
            return $user->toArray();
        }, $this->getArrayCopy());
    }
}

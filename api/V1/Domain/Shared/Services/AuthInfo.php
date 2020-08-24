<?php

declare(strict_types = 1);

namespace Borto\Domain\Shared\Services;

use Borto\Domain\Authentication\Entities\UserEntity;

interface AuthInfo
{
    public function getUser(): ?UserEntity;
}

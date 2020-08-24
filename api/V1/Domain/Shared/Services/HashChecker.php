<?php

declare(strict_types = 1);

namespace Borto\Domain\Shared\Services;

interface HashChecker
{
    public function check(string $original, string $hashed): bool;
}

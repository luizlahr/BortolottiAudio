<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\Services;

use Illuminate\Contracts\Hashing\Hasher;
use Borto\Domain\Shared\Services\HashChecker;

class IlluminateHashChecker implements HashChecker
{
    private Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function check(string $text, string $hash): bool
    {
        return $this->hasher->check($text, $hash);
    }
}

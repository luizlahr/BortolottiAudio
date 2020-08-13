<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\Services;

use Illuminate\Contracts\Hashing\Hasher;
use Borto\Domain\Shared\Services\HashMaker;

class IlluminateHashMaker implements HashMaker
{
    private Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function make(string $text): string
    {
        return $this->hasher->make($text);
    }
}

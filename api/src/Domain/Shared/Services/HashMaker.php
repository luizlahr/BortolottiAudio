<?php

declare(strict_types = 1);

namespace Borto\Domain\Shared\Services;

interface HashMaker
{
    public function make(string $text): string;
}

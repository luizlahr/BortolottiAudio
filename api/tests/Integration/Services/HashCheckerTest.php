<?php

declare(strict_types = 1);

namespace Tests\Integration\Services;

use Borto\Domain\Shared\Services\HashChecker;
use Borto\Infrastructure\Services\IlluminateHashChecker;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HashCheckerTest extends TestCase
{
    public function testItCanCheckAHashString()
    {
        $word = $this->faker->word;
        $hash = Hash::make($word);

        $checker = $this->getChecker();
        $response = $checker->check($word, $hash);
        $this->assertTrue($response);
    }

    public function getChecker(): HashChecker
    {
        $hasher = new BcryptHasher();
        return new IlluminateHashChecker($hasher);
    }
}

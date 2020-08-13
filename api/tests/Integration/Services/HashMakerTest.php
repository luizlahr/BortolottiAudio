<?php

declare(strict_types = 1);

namespace Tests\Integration\Services;

use Borto\Domain\Shared\Services\HashMaker;
use Borto\Infrastructure\Services\IlluminateHashMaker;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HashMakerTest extends TestCase
{
    public function testItCanMakeAHash()
    {
        $word = $this->faker->word;

        $maker = $this->getMaker();
        $response = $maker->make($word);
        $this->assertTrue(Hash::check($word, $response));
    }

    public function getMaker(): HashMaker
    {
        $hasher = new BcryptHasher();
        return new IlluminateHashMaker($hasher);
    }
}

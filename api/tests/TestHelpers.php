<?php

declare(strict_types = 1);

namespace Tests;

use Borto\Infrastructure\DB\Models\User;

trait TestHelpers
{
    public function randomId(): int
    {
        return $this->faker->numberBetween(1, 999);
    }

    public function randomPassword(int $size)
    {
        $word = '';
        for ($wordSize = 1; $wordSize <= $size; $wordSize++) {
            $word .= $this->faker->randomLetter;
        }

        return $word;
    }

    public function randomWord(int $size)
    {
        $word = '';
        for ($wordSize = 1; $wordSize <= $size; $wordSize++) {
            $word .= $this->faker->randomLetter;
        }

        return $word;
    }

    public function randomToken(): string
    {
        return $this->faker->sha256;
    }

    public function authenticateUser(User $user)
    {
        return $user->createToken('user-token', ['admin:full'])->plainTextToken;
    }

    public function setAuthHeader(User $user): array
    {
        $token = $this->authenticateUser($user);
        return ["Authorization" => "Bearer {$token}"];
    }
}

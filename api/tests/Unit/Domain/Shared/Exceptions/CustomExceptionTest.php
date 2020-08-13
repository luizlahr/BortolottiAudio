<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Shared\Exceptions;

use Tests\BaseTestCase;
use Borto\Domain\Shared\Exceptions\CustomException;
use Borto\Domain\Authentication\Exceptions\DuplicatedUserEmailException;

class CustomExceptionTest extends BaseTestCase
{
    public function testItCanSetMessage()
    {
        $message = $this->faker->sentence;
        $exception = new CustomException($message);
        $this->assertEquals($exception->getMessage(), $message);
    }
}

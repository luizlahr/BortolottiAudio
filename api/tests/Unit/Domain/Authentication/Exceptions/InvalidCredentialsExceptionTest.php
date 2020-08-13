<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Exceptions;

use Tests\BaseTestCase;
use Borto\Domain\Shared\Exceptions\CustomException;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Exceptions\DuplicatedUserEmailException;
use Borto\Domain\Authentication\Exceptions\InvalidCredentialsException;

class InvalidCredentialsExceptionTest extends BaseTestCase
{
    public function testItExtendsCustomException()
    {
        $exception = new InvalidCredentialsException();
        $this->assertInstanceOf(CustomException::class, $exception);
    }
}

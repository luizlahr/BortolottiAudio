<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Exceptions;

use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Shared\Exceptions\CustomException;
use Tests\BaseTestCase;

class UserNotFoundExceptionTest extends BaseTestCase
{
    public function testItExtendsCustomException()
    {
        $exception = new UserNotFoundException();
        $this->assertInstanceOf(CustomException::class, $exception);
    }

    public function testItHasErrorMessages()
    {
        $message = "Usuário não encontrado.";

        $exception = new UserNotFoundException();
        $this->assertEquals($exception->getMessage(), $message);
    }
}

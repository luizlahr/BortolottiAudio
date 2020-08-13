<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Exceptions;

use Tests\BaseTestCase;
use Borto\Domain\Shared\Exceptions\CustomException;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Exceptions\DuplicatedUserEmailException;

class DuplicatedUserEmailExceptionTest extends BaseTestCase
{
    public function testItExtendsCustomException()
    {
        $exception = new DuplicatedUserEmailException();
        $this->assertInstanceOf(CustomException::class, $exception);
    }

    public function testItHasErrorMessages()
    {
        $errors = [["email" => "o e-mail já está sendo utilizado."]];

        $exception = new DuplicatedUserEmailException();
        $this->assertEquals($exception->errors(), $errors);
    }
}

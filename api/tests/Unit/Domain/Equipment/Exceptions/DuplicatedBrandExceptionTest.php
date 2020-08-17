<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Exceptions;

use Borto\Domain\Equipment\Exceptions\DuplicatedBrandException;
use Borto\Domain\Shared\Exceptions\CustomException;
use Tests\BaseTestCase;

class DuplicatedBrandExceptionTest extends BaseTestCase
{
    public function testItExtendsCustomException()
    {
        $exception = new DuplicatedBrandException();
        $this->assertInstanceOf(CustomException::class, $exception);
    }

    public function testItHasErrorMessages()
    {
        $errors = [["name" => "esta marca já existe."]];

        $exception = new DuplicatedBrandException();
        $this->assertEquals($exception->errors(), $errors);
    }
}

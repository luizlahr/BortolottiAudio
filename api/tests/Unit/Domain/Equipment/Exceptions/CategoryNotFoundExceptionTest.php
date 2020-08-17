<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Exceptions;

use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Shared\Exceptions\CustomException;
use Tests\BaseTestCase;

class CategoryNotFoundExceptionTest extends BaseTestCase
{
    public function testItExtendsCustomException()
    {
        $exception = new CategoryNotFoundException();
        $this->assertInstanceOf(CustomException::class, $exception);
    }

    public function testItHasErrorMessages()
    {
        $message = "Categoria não encontrada.";

        $exception = new CategoryNotFoundException();
        $this->assertEquals($exception->getMessage(), $message);
    }
}

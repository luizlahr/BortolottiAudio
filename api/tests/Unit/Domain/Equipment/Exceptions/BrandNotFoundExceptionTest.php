<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Exceptions;

use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Shared\Exceptions\CustomException;
use Tests\BaseTestCase;

class BrandNotFoundExceptionTest extends BaseTestCase
{
    public function testItExtendsCustomException()
    {
        $exception = new BrandNotFoundException();
        $this->assertInstanceOf(CustomException::class, $exception);
    }

    public function testItHasErrorMessages()
    {
        $message = "Marca não encontrada.";

        $exception = new BrandNotFoundException();
        $this->assertEquals($exception->getMessage(), $message);
    }
}

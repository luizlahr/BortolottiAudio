<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication\Exceptions;

use Borto\Domain\Equipment\Exceptions\DuplicatedCategoryException;
use Borto\Domain\Shared\Exceptions\CustomException;
use Tests\BaseTestCase;

class DuplicatedCategoryExceptionTest extends BaseTestCase
{
    public function testItExtendsCustomException()
    {
        $exception = new DuplicatedCategoryException();
        $this->assertInstanceOf(CustomException::class, $exception);
    }

    public function testItHasErrorMessages()
    {
        $errors = [["name" => "esta categoria já existe."]];

        $exception = new DuplicatedCategoryException();
        $this->assertEquals($exception->errors(), $errors);
    }
}

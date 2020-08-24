<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class InvalidCredentialsException extends CustomException
{
    public function __construct()
    {
        // HTTP:401
        parent::__construct('Credenciais inválidas.');
        // TODO: Use translations
    }
}

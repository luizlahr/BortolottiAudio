<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class UserNotFoundException extends CustomException
{
    public function __construct()
    {
        // HTTP:422
        parent::__construct('Usuário não encontrado.');
        // TODO: Use translations
    }
}

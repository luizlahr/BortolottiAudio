<?php

declare(strict_types = 1);

namespace Borto\Domain\Authentication\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class DuplicatedUserEmailException extends CustomException
{
    public function __construct()
    {
        // HTTP:422
        parent::__construct('o e-mail já está sendo utilizado.');
        // TODO: Use translations
        $this->messages = [[
            "email" => "o e-mail já está sendo utilizado."
        ]];
    }
}

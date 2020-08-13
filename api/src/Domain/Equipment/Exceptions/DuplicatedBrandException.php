<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class DuplicatedBrandException extends CustomException
{
    public function __construct()
    {
        // HTTP:422
        parent::__construct('esta marca já existe.');
        // TODO: Use translations
        $this->messages = [[
            "name" => "esta marca já existe."
        ]];
    }
}

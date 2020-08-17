<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class DuplicatedModelException extends CustomException
{
    public function __construct()
    {
        // HTTP:422
        parent::__construct('este modelo já existe.');
        // TODO: Use translations
        $this->messages = [[
            "name" => "este modelo já existe."
        ]];
    }
}

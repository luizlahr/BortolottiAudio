<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class DuplicatedCategoryException extends CustomException
{
    public function __construct()
    {
        // HTTP:422
        parent::__construct('esta categoria já existe.');
        // TODO: Use translations
        $this->messages = [[
            "name" => "esta categoria já existe."
        ]];
    }
}

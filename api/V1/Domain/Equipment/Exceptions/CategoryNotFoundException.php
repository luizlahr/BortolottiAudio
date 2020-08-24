<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class CategoryNotFoundException extends CustomException
{
    public function __construct()
    {
        // HTTP:422
        parent::__construct('Categoria não encontrada.');
        // TODO: Use translations
    }
}

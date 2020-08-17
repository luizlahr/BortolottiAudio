<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class ModelNotFoundException extends CustomException
{
    public function __construct()
    {
        // HTTP:422
        parent::__construct('Modelo não encontrado.');
        // TODO: Use translations
    }
}

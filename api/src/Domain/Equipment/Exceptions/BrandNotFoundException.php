<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class BrandNotFoundException extends CustomException
{
    public function __construct()
    {
        // HTTP:422
        parent::__construct('Marca não encontrada.');
        // TODO: Use translations
    }
}

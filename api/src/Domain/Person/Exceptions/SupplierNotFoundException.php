<?php

declare(strict_types = 1);

namespace Borto\Domain\Person\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class SupplierNotFoundException extends CustomException
{
    public function __construct()
    {
        // HTTP:401
        parent::__construct('Fornecedor não encontrado.');
        // TODO: Use translations
    }
}

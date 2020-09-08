<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class OrderNotFoundException extends CustomException
{
    public function __construct()
    {
        // HTTP:401
        parent::__construct('Ordem não encontrada.');
        // TODO: Use translations
    }
}

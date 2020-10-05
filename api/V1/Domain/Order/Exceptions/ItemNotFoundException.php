<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class ItemNotFoundException extends CustomException
{
    public function __construct()
    {
        // HTTP:401
        parent::__construct('Item não encontrado.');
        // TODO: Use translations
    }
}

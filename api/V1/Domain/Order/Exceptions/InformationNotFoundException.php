<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class InformationNotFoundException extends CustomException
{
    public function __construct()
    {
        // HTTP:401
        parent::__construct('Informação não encontrada.');
        // TODO: Use translations
    }
}

<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class UnableToChangeOrderStatusException extends CustomException
{
    public function __construct(string $statusFrom = null, string $statusTo = null)
    {
        // HTTP:401
        if ($statusFrom && $statusTo) {
            parent::__construct("Não é possível alterar o status da Ordem de [{$statusFrom}] para [{$statusTo}]!");
        } else {
            parent::__construct('Não foi possível alterar o status da Ordem!');
        }

        // TODO: Use translations
    }
}

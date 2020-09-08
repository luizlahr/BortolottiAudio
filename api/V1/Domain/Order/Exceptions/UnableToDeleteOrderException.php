<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class UnableToDeleteOrderException extends CustomException
{
    public function __construct(string $status = null)
    {
        // HTTP:401
        if ($status) {
            parent::__construct("Não é possível excluir uma Ordem com status {$status}!");
        } else {
            parent::__construct('Não é possível excluir a Ordem com o Status atual!');
        }

        // TODO: Use translations
    }
}

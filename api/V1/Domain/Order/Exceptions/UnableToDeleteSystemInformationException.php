<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class UnableToDeleteSystemInformationException extends CustomException
{
    public function __construct()
    {
        // HTTP:403
        parent::__construct('Não é possível excluir informações inseridas pelo sistema.');
        // TODO: Use translations
    }
}

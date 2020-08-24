<?php

declare(strict_types = 1);

namespace Borto\Domain\Shared\Exceptions;

use Borto\Domain\Shared\Exceptions\CustomException;

class NotAllowedException extends CustomException
{
    public function __construct()
    {
        // HTTP:403
        parent::__construct('Ação não autorizada.');
        // TODO: Use translations
    }
}

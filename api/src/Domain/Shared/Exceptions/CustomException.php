<?php

declare(strict_types = 1);

namespace Borto\Domain\Shared\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected array $messages = [];

    public function __construct($message)
    {
        parent::__construct($message);
    }

    public function errors(): array
    {
        return $this->messages;
    }
}

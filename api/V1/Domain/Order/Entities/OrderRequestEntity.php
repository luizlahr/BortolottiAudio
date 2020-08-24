<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Entities;

class OrderRequestEntity
{
    private int $customerId;

    public function __construct(array $requestData)
    {
        $this->customerId = $requestData["customer_id"];
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function toArray()
    {
        return [
            "customer_id" => $this->customerId
        ];
    }
}

<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Entities;

use Borto\Domain\Person\Entities\PersonEntity;

class OrderFactory
{
    public function make(
        int $id,
        ?int $status,
        ?float $credit,
        int $customerId,
        string $createdAt,
        ?string $dueTo,
        ?string $quotedAt,
        ?string $approvedAt,
        ?string $finishedAt,
        ?string $deliveredAt,
        ?PersonEntity $customer
    ): OrderEntity {
        return new OrderEntity(
            $id,
            $status,
            $credit,
            $customerId,
            $createdAt,
            $dueTo,
            $quotedAt,
            $approvedAt,
            $finishedAt,
            $deliveredAt,
            $customer
        );
    }
}

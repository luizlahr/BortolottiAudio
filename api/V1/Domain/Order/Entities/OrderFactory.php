<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

use Borto\Domain\Person\Entities\PersonEntity;
use DateTimeImmutable;
use V1\Domain\Order\Entities\OrderEntity;

class OrderFactory
{
    public function make(
        int $id,
        int $status,
        float $credit,
        int $customerId,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $dueTo,
        ?DateTimeImmutable $quotedAt,
        ?DateTimeImmutable $approvedAt,
        ?DateTimeImmutable $finishedAt,
        ?DateTimeImmutable $deliveredAt,
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

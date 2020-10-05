<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Item\Entities;

class MaintenanceItemFactory
{
    public function make(
        string $id,
        string $orderId,
        int $modelId,
        ?string $serialNumber,
        ?string $notes,
        ?float $value = 0
    ) {
        return new MaintenanceItemEntity(
            $id,
            $orderId,
            $modelId,
            $serialNumber,
            $notes,
            $value
        );
    }
}

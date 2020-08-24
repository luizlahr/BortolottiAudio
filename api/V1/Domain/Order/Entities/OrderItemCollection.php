<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Entities;

use ArrayObject;
use Borto\Domain\Equipment\Entities\OrderItem;

class OrderItemCollection extends ArrayObject
{
    public function add(OrderItem $item): void
    {
        $this->append($item);
    }

    /** @param array<MaintenanceItemEntity|SaleItemEntity> $items */
    public function fill(array $items): void
    {
        foreach ($items as $item) {
            $this->append($item);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($item) {
            return $item->toArray();
        }, $this->getArrayCopy());
    }
}

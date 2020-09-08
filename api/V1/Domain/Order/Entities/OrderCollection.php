<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Entities;

use ArrayObject;

class OrderCollection extends ArrayObject
{
    public function add(OrderEntity $order): void
    {
        $this->append($order);
    }

    /** @param array<OrderEntity> $orders */
    public function fill(array $orders): void
    {
        foreach ($orders as $order) {
            $this->append($order);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($order) {
            return $order->toArray();
        }, $this->getArrayCopy());
    }
}

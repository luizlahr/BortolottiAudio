<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Item\Entities;

class SaleItemFactory
{
    public function make(
        int $id,
        int $orderId,
        string $name,
        float $amount,
        string $measure,
        float $value
    ) {
        return new SaleItemEntity(
            $id,
            $orderId,
            $name,
            $amount,
            $measure,
            $value
        );
    }
}

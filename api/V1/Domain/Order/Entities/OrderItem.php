<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Entities;

interface OrderItem
{
    const TYPE_SALE = 'S';
    const TYPE_MAINTENANCE = 'M';

    public function getId(): int;
    public function getOrderId(): int;
    public function getType(): string;
    public function getTotal(): float;
    public function toArray(): array;
}

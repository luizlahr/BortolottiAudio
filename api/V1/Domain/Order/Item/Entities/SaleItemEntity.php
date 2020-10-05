<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Item\Entities;

class SaleItemEntity implements OrderItem
{
    private int $id;
    private int $orderId;
    private string $type;
    private string $name;
    private float $amount;
    private string $measure;
    private float $value;

    public function __construct(
        int $id,
        int $orderId,
        string $name,
        float $amount,
        string $measure,
        float $value
    ) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->type = self::TYPE_SALE;
        $this->name = $name;
        $this->amount = $amount;
        $this->measure = $measure;
        $this->value = $value;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getMeasure(): string
    {
        return $this->measure;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getTotal(): float
    {
        return $this->value * $this->amount;
    }

    public function toArray(): array
    {
        return [
            "id"       => $this->id,
            "order_id" => $this->orderId,
            "name"     => $this->name,
            "amount"   => $this->amount,
            "measure"  => $this->measure,
            "value"    => $this->value,
            "total"    => $this->getTotal()
        ];
    }
}

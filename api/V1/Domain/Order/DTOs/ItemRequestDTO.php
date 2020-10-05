<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\DTOs;

class ItemRequestDTO
{
    private int $orderId;
    private string $type;
    private string $name;
    private float $amount;
    private string $measure;
    private int $modelId;
    private ?string $serialNumber;
    private ?string $notes;
    private ?float $value;

    public function __construct(
        int $orderId,
        string $type,
        string $name,
        float $amount,
        string $measure,
        int $modelId,
        ?string $serialNumber,
        ?string $notes,
        ?float $value
    ) {
        $this->orderId = $orderId;
        $this->type = $type;
        $this->name = $name;
        $this->amount = $amount;
        $this->measure = $measure;
        $this->modelId = $modelId;
        $this->serialNumber = $serialNumber;
        $this->notes = $notes;
        $this->value = $value;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
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

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            'order_id'      => $this->orderId,
            'type'          => $this->type,
            'name'          => $this->name,
            'amount'        => $this->amount,
            'measure'       => $this->measure,
            'model_id'      => $this->modelId,
            'serial_number' => $this->serialNumber,
            'notes'         => $this->notes,
            'value'         => $this->value
        ];
    }
}

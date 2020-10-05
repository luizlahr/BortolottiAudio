<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Item\Entities;

use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Equipment\Entities\ModelEntity;

class MaintenanceItemEntity implements OrderItem
{
    private int $id;
    private int $orderId;
    private string $type;
    private int $modelId;
    private ?string $serialNumber;
    private ?string $notes;
    private ?float $value;
    private ?CategoryEntity $category;
    private ?BrandEntity $brand;
    private ?ModelEntity $model;

    public function __construct(
        string $id,
        string $orderId,
        int $modelId,
        ?string $serialNumber,
        ?string $notes,
        ?float $value = 0,
        ?CategoryEntity $category = null,
        ?BrandEntity $brand = null,
        ?ModelEntity $model = null
    ) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->type = self::TYPE_MAINTENANCE;
        $this->modelId = $modelId;
        $this->serialNumber = $serialNumber;
        $this->notes = $notes;
        $this->value = $value;
        $this->category = $category;
        $this->brand = $brand;
        $this->model = $model;
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

    public function getModelId(): ?int
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

    public function getTotal(): float
    {
        return $this->value ?? 0;
    }

    public function getCategory(): ?CategoryEntity
    {
        return $this->category;
    }

    public function getBrand(): ?BrandEntity
    {
        return $this->brand;
    }

    public function getModel(): ?ModelEntity
    {
        return $this->model;
    }

    public function toArray(): array
    {
        return [
            "id"            => $this->id,
            "order_id"      => $this->orderId,
            "model_id"      => $this->modelId,
            "serial_number" => $this->serialNumber,
            "notes"         => $this->notes,
            "value"         => $this->value,
            "category"      => $this->value,
            "brand"         => $this->value,
            "model"         => $this->value,
        ];
    }
}

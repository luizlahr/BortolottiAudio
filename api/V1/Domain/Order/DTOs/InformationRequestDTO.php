<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\DTOs;

class InformationRequestDTO
{
    private int $orderId;
    private ?int $userId;
    private string $type;
    private string $text;

    public function __construct(
        array $request
    ) {
        $this->orderId = $request["order_id"];
        $this->userId = $request["user_id"];
        $this->type = $request["type"];
        $this->text = $request["text"];
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function toArray(): array
    {
        return [
            "order_id" => $this->orderId,
            "user_id"  => $this->userId,
            "type"     => $this->type,
            "text"     => $this->text,
        ];
    }
}

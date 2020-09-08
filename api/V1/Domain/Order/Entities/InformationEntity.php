<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Entities;

use Borto\Domain\Shared\Clock;
use DateTimeImmutable;

class InformationEntity
{
    const TYPE_SYSTEM = 'system';
    const TYPE_USER = 'user';

    private int $id;
    private int $orderId;
    private ?int $userId;
    private string $type;
    private string $text;
    private Clock $date;

    public function __construct(
        int $id,
        int $orderId,
        ?int $userId,
        string $type,
        string $text,
        string $date
    ) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->type = $type;
        $this->text = $text;
        $this->date = Clock::createFromString($date);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }


    public function getUserId(): ?int
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

    public function getDate(): DateTimeImmutable
    {
        return $this->date->toDateTime();
    }

    public function toArray(): array
    {
        return [
            "id"       => $this->id,
            "order_id" => $this->orderId,
            "user_id"  => $this->userId,
            "type"     => $this->type,
            "text"     => $this->text,
            "date"     => $this->date->toString()
        ];
    }
}

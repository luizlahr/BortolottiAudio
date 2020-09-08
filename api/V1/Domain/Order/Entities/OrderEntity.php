<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Entities;

use Borto\Domain\Person\Entities\PersonEntity;
use DateTimeImmutable;

class OrderEntity
{
    const ORDER_DRAFT = 1;
    const ORDER_WAITING_QUOTE = 2;
    const ORDER_QUOTED = 3;
    const ORDER_APPROVED = 4;
    const ORDER_DISAPPROVED = 5;
    const ORDER_FINISHED = 6;
    const ORDER_DELIVERED = 7;
    const ORDER_CANCELED = 8;

    const STATUS_NAMES = [
        self::ORDER_DRAFT         => "Rascunho",
        self::ORDER_WAITING_QUOTE => "Aguardando Orçamento",
        self::ORDER_QUOTED        => "Aguardando Aprovação",
        self::ORDER_APPROVED      => "Aprovado",
        self::ORDER_DISAPPROVED   => "Reprovado",
        self::ORDER_FINISHED      => "Finalizado",
        self::ORDER_DELIVERED     => "Entregue",
        self::ORDER_CANCELED      => "Cancelada",
    ];


    private int $id;
    private ?int $status;
    private ?float $credit;
    private int $customerId;
    private string $createdAt;
    private ?string $dueTo;
    private ?string $quotedAt;
    private ?string $approvedAt;
    private ?string $finishedAt;
    private ?string $deliveredAt;
    private ?PersonEntity $customer;

    public function __construct(
        int $id,
        ?int $status,
        ?float $credit,
        int $customerId,
        string $createdAt,
        ?string $dueTo,
        ?string $quotedAt,
        ?string $approvedAt,
        ?string $finishedAt,
        ?string $deliveredAt,
        ?PersonEntity $customer
    ) {
        $this->id = $id;
        $this->status = $status ?? 1;
        $this->credit = $credit;
        $this->customerId = $customerId;
        $this->createdAt = $createdAt;
        $this->dueTo = $dueTo;
        $this->quotedAt = $quotedAt;
        $this->approvedAt = $approvedAt;
        $this->finishedAt = $finishedAt;
        $this->deliveredAt = $deliveredAt;
        $this->customer = $customer;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatusId(): int
    {
        return $this->status;
    }

    public function getStatus(): string
    {
        return self::STATUS_NAMES[$this->status];
    }

    public function isDraft(): bool
    {
        return $this->status === self::ORDER_DRAFT;
    }

    public function isWaitingForQuote(): bool
    {
        return $this->status === self::ORDER_WAITING_QUOTE;
    }

    public function isQuoted(): bool
    {
        return $this->status === self::ORDER_QUOTED;
    }

    public function isApproved(): bool
    {
        return $this->status === self::ORDER_APPROVED;
    }

    public function isDisapproved(): bool
    {
        return $this->status === self::ORDER_DISAPPROVED;
    }

    public function isFinished(): bool
    {
        return $this->status === self::ORDER_FINISHED;
    }

    public function isDelivered(): bool
    {
        return $this->status === self::ORDER_DELIVERED;
    }

    public function isCanceled(): bool
    {
        return $this->status === self::ORDER_CANCELED;
    }

    public function getCredit(): float
    {
        return $this->credit;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getCreatedAt(): string
    {
        return $this->formatDate(new DateTimeImmutable($this->createdAt));
    }

    public function getDueTo(): ?string
    {
        if ($this->dueTo === null) {
            return null;
        }

        return $this->formatDate(new DateTimeImmutable($this->dueTo));
    }

    public function getQuotedAt(): ?string
    {
        if ($this->quotedAt === null) {
            return null;
        }

        return $this->formatDate(new DateTimeImmutable($this->quotedAt));
    }

    public function getApprovedAt(): ?string
    {
        if ($this->approvedAt === null) {
            return null;
        }

        return $this->formatDate(new DateTimeImmutable($this->approvedAt));
    }

    public function getFinishedAt(): ?string
    {
        if ($this->finishedAt === null) {
            return null;
        }

        return $this->formatDate(new DateTimeImmutable($this->finishedAt));
    }

    public function getDeliveredAt(): ?string
    {
        if ($this->deliveredAt === null) {
            return null;
        }

        return $this->formatDate(new DateTimeImmutable($this->deliveredAt));
    }

    public function getCustomer(): PersonEntity
    {
        return $this->customer;
    }

    public function toArray(): array
    {
        return [
            "id"           => $this->id,
            "status_id"    => $this->status,
            "status"       => $this->getStatus(),
            "credit"       => $this->credit,
            "customer_id"  => $this->customerId,
            "created_at"   => $this->getCreatedAt(),
            "due_to"       => $this->getDueTo(),
            "quoted_at"    => $this->getquotedAt(),
            "approved_at"  => $this->getApprovedAt(),
            "finished_at"  => $this->getFinishedAt(),
            "delivered_at" => $this->getDeliveredAt(),
            "customer"     => $this->customer->toArray(),
        ];
    }

    private function formatDate(?DateTimeImmutable $date): ?string
    {
        if (empty($date)) {
            return null;
        }

        return $date->format('Y-m-d H:i:s');
    }
}

<?php

declare(strict_types = 1);

namespace V1\Domain\Order\Entities;

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

    const STATUS_NAMES = [
        "Rascunho"             => self::ORDER_DRAFT,
        "Aguardando Orçamento" => self::ORDER_WAITING_QUOTE,
        "Aguardando Aprovação" => self::ORDER_QUOTED,
        "Aprovado"             => self::ORDER_APPROVED,
        "Reprovado"            => self::ORDER_DISAPPROVED,
        "Finalizado"           => self::ORDER_FINISHED,
        "Entregue"             => self::ORDER_DELIVERED,
    ];

    private int $id;
    private int $status;
    private float $credit;
    private int $customerId;
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $dueTo;
    private ?DateTimeImmutable $quotedAt;
    private ?DateTimeImmutable $approvedAt;
    private ?DateTimeImmutable $finishedAt;
    private ?DateTimeImmutable $deliveredAt;
    private ?PersonEntity $customer;

    public function __construct(
        int $id,
        int $status,
        float $credit,
        int $customerId,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $dueTo,
        ?DateTimeImmutable $quotedAt,
        ?DateTimeImmutable $approvedAt,
        ?DateTimeImmutable $finishedAt,
        ?DateTimeImmutable $deliveredAt,
        ?PersonEntity $customer
    ) {
        $this->id = $id;
        $this->status = $status;
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

    public function getStatus(): int
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

    public function getCredit(): float
    {
        return $this->credit;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDueTo(): DateTimeImmutable
    {
        return $this->dueTo;
    }

    public function getQuotedAt(): DateTimeImmutable
    {
        return $this->quotedAt;
    }

    public function getApprovedAt(): DateTimeImmutable
    {
        return $this->approvedAt;
    }

    public function getFinishedAt(): DateTimeImmutable
    {
        return $this->finishedAt;
    }

    public function getDeliveredAt(): DateTimeImmutable
    {
        return $this->deliveredAt;
    }

    public function getCustomer(): PersonEntity
    {
        return $this->customer;
    }

    public function toArray(): array
    {
        return [
            "id"          => $this->id,
            "status_id"   => $this->status,
            "status"      => $this->getStatus(),
            "credit"      => $this->credit,
            "customerId"  => $this->customerId,
            "createdAt"   => $this->createdAt,
            "dueTo"       => $this->dueTo,
            "quotedAt"    => $this->quotedAt,
            "approvedAt"  => $this->approvedAt,
            "deliveredAt" => $this->deliveredAt,
            "customer"    => $this->customer,
        ];
    }
}

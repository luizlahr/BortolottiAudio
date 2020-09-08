<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\DTOs;

class OrderStatusDTO
{
    const DRAFT = 1;
    const WAITING_QUOTE = 2;
    const QUOTED = 3;
    const APPROVED = 4;
    const DISAPPROVED = 5;
    const FINISHED = 6;
    const DELIVERED = 7;
    const CANCELED = 8;

    private const STATUS = [
        1 => "Rascunho",
        2 => "Aguard. Orçamento",
        3 => "Aguard. Aprovação",
        4 => "Aprovado",
        5 => "Reprovado",
        6 => "Finalizado",
        7 => "Entregue",
        8 => "Cancelada"
    ];

    public static function fromId(int $id): string
    {
        return self::STATUS[$id];
    }

    public static function fromName(string $text): array
    {
        $ids = [];
        foreach (self::STATUS as $id => $name) {
            if (strpos(strToLower($text), strToLower($name))) {
                array_push($ids, $id);
            }
        }
        return $ids;
    }
}

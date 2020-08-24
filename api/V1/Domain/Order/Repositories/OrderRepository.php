<?php

declare(strict_types = 1);

namespace Borto\Domain\Order;

use Borto\Domain\Order\Entities\OrderCollection;
use V1\Domain\Order\Entities\OrderEntity;

interface OrderRepository
{
    public function getAll(): OrderCollection;
    public function filter(array $filter): OrderCollection;
    public function getById(int $id): ?OrderEntity;
    public function getByCustomerId(int $customerId): ?OrderEntity;
    public function getItemsByOrderId(int $orderId): ?OrderEntity;
    public function getItemById(int $id): ?OrderEntity;
    public function createOrder(array $brandData): OrderEntity;
    public function updateOrder(int $id, array $brandData): OrderEntity;
    public function deleteOrder(int $id): void;
}

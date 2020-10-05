<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Repositories;

use Borto\Domain\Order\Entities\OrderCollection;
use Borto\Domain\Order\Entities\OrderEntity;
use Borto\Domain\Order\Entities\OrderRequestEntity;
use Borto\Domain\Order\Item\Entities\OrderItem;
use Borto\Domain\Order\Item\Entities\OrderItemCollection;

interface OrderRepository
{
    public function getAll(): OrderCollection;
    public function filter(?string $filter): OrderCollection;
    public function getById(int $id): ?OrderEntity;
    public function getByCustomerId(int $customerId): ?OrderEntity;
    public function getItemsByOrderId(int $orderId): OrderItemCollection;
    public function getItemById(int $id): ?OrderItem;
    public function createOrder(OrderRequestEntity $orderRequest): OrderEntity;
    public function updateOrder(int $id, array $orderData): OrderEntity;
    public function deleteOrder(int $id): void;
}

<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Item\Repositories;

use Borto\Domain\Order\DTOs\ItemRequestDTO;
use Borto\Domain\Order\Item\Entities\OrderItem;
use Borto\Domain\Order\Item\Entities\OrderItemCollection;

interface ItemRepository
{
    public function getById(int $id): ?OrderItem;
    public function getByOrderId(int $orderId): OrderItemCollection;
    public function createItem(ItemRequestDTO $itemRequest): OrderItem;
    public function updateItem(int $id, ItemRequestDTO $itemRequest): OrderItem;
    public function deleteItem(int $id): void;
}

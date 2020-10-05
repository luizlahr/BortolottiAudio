<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\DB\Repositories;

use Borto\Domain\Order\DTOs\ItemRequestDTO;
use Borto\Domain\Order\Exceptions\ItemNotFoundException;
use Borto\Domain\Order\Item\Entities\OrderItem;
use Borto\Domain\Order\Item\Entities\OrderItemCollection;
use Borto\Domain\Order\Item\Repositories\ItemRepository;
use Borto\Infrastructure\DB\Models\OrderItem as ItemModel;
use Illuminate\Database\Eloquent\Collection;

class EloquentItemRepository implements ItemRepository
{
    private ItemModel $item;

    public function __construct()
    {
        $this->item = new ItemModel();
    }

    public function getByOrderId(int $orderId): OrderItemCollection
    {
        $items = $this->item->where('order_id', $orderId)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $this->makeCollection($items);
    }

    public function getById(int $id): ?OrderItem
    {
        $item = $this->item->find($id);

        if (empty($item)) {
            return null;
        }

        return $item->toEntity();
    }

    public function createItem(ItemRequestDTO $itemRequest): OrderItem
    {
        $item = $this->item->create($itemRequest->toArray());
        return $item->toEntity();
    }

    public function updateItem(int $id, ItemRequestDTO $itemRequest): OrderItem
    {
        $item = $this->item->find($id);

        if (empty($item)) {
            throw new ItemNotFoundException();
        }

        $this->item->update($itemRequest->toArray());

        return $this->item->toEntity();
    }


    public function deleteItem(int $id): void
    {
        $item = $this->item->find($id);

        if (empty($item)) {
            throw new ItemNotFoundException();
        }

        $item->delete();
    }

    private function makeCollection(Collection $items): OrderItemCollection
    {
        $collection = new OrderItemCollection();
        $collection->fill($items->all());

        return $collection;
    }
}

<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\DB\Repositories;

use Borto\Domain\Order\DTOs\OrderStatusDTO;
use Borto\Domain\Order\Entities\MaintenanceItemEntity;
use Borto\Domain\Order\Entities\OrderCollection;
use Borto\Domain\Order\Entities\OrderEntity;
use Borto\Domain\Order\Entities\OrderItem;
use Borto\Domain\Order\Entities\OrderItemCollection;
use Borto\Domain\Order\Entities\OrderRequestEntity;
use Borto\Domain\Order\Entities\SaleItemEntity;
use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Repositories\OrderRepository;
use Borto\Infrastructure\DB\Models\Order;
use Borto\Infrastructure\DB\Models\OrderItem as ItemModel;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrderRepository implements OrderRepository
{
    private Order $order;
    private ItemModel $item;

    public function __construct()
    {
        $this->order = new Order();
        $this->item = new ItemModel();
    }

    public function filter(?string $filter): OrderCollection
    {
        if (!empty($filter)) {
            $this->setFilters($filter);
        }

        $orders = $this->order->with('customer')->get();
        return $this->makeCollection($orders);
    }

    public function getAll(): OrderCollection
    {
        $orders = $this->order->all();
        return $this->makeCollection($orders);
    }

    public function getById(int $id): ?OrderEntity
    {
        $order = $this->order->find($id);

        if (empty($order)) {
            return null;
        }

        return $order->toEntity();
    }

    public function getByCustomerId(int $customerId): ?OrderEntity
    {
        $order = $this->order->where('customer_id', $customerId)->first();

        if (empty($order)) {
            return null;
        }

        return $order->toEntity();
    }

    public function getItemsByOrderId(int $orderId): OrderItemCollection
    {
        $order = $this->order->find($orderId);
        $items = $order->items();

        $itemCollection = $this->makeItemsCollection($items);

        return $itemCollection;
    }

    public function getItemById(int $id): ?OrderItem
    {
        $item = $this->item->find($id);

        if (empty($item)) {
            return null;
        }

        return $item->toEntity();
    }

    public function createOrder(OrderRequestEntity $orderRequest): OrderEntity
    {
        $order = $this->order->create($orderRequest->toArray());
        return $order->toEntity();
    }

    public function updateOrder(int $id, array $orderData): OrderEntity
    {
        $order = $this->order->find($id);

        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        $order->update($orderData);

        return $order->toEntity();
    }

    public function deleteOrder(int $id): void
    {
        $order = $this->order->find($id);

        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        $order->delete();
    }

    private function setFilters(string $filter): void
    {
        $this->order->where(function ($query) use ($filter) {
            return $query->whereIn('status', OrderStatusDTO::fromName($filter));
        });
    }

    /** @param Collection<Order> $orders */
    private function makeCollection(Collection $orders): OrderCollection
    {
        $orderList = new OrderCollection();
        foreach ($orders as $order) {
            $orderList->add($order->toEntity());
        }
        return $orderList;
    }

    /** @param Collection<SaleItemEntity|MaintenanceItemEntity> $orders */
    private function makeItemsCollection(Collection $items): OrderItemCollection
    {
        $itemList = new OrderItemCollection();
        foreach ($items as $item) {
            $itemList->add($item->toEntity());
        }
        return $itemList;
    }
}

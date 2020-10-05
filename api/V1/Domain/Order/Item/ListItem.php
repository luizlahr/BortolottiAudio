<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Item;

use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Item\Entities\OrderItemCollection;
use Borto\Domain\Order\Item\Repositories\ItemRepository;
use Borto\Domain\Order\Repositories\OrderRepository;

class ListItem
{
    private OrderRepository $orderRepository;
    private ItemRepository $itemRepository;

    public function __construct(OrderRepository $orderRepository, ItemRepository $itemRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->itemRepository = $itemRepository;
    }

    public function execute(int $orderId): OrderItemCollection
    {
        $order = $this->orderRepository->getById($orderId);

        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        return $this->itemRepository->getByOrderId($orderId);
    }
}

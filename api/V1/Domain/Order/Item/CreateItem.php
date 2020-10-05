<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Item;

use Borto\Domain\Order\DTOs\ItemRequestDTO;
use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Item\Entities\OrderItem;
use Borto\Domain\Order\Item\Repositories\ItemRepository;
use Borto\Domain\Order\Repositories\OrderRepository;

class CreateItem
{
    private OrderRepository $orderRepository;
    private ItemRepository $itemRepository;

    public function __construct(OrderRepository $orderRepository, ItemRepository $itemRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->itemRepository = $itemRepository;
    }

    public function execute(ItemRequestDTO $itemRequest): OrderItem
    {
        $order = $this->orderRepository->getById($itemRequest->getOrderId());

        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        return $this->itemRepository->createItem($itemRequest);
    }
}

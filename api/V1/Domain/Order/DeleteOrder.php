<?php

declare(strict_types = 1);

namespace Borto\Domain\Order;

use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Exceptions\UnableToDeleteOrderException;
use Borto\Domain\Order\Repositories\OrderRepository;

class DeleteOrder
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(int $id): void
    {
        $order = $this->orderRepository->getById($id);

        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        if (!in_array($order->getStatusId(), [
            $order::ORDER_DRAFT,
            $order::ORDER_DISAPPROVED,
            $order::ORDER_APPROVED,
            $order::ORDER_QUOTED,
            $order::ORDER_WAITING_QUOTE,
            $order::ORDER_CANCELED
        ])) {
            throw new UnableToDeleteOrderException($order->getStatus());
        }

        $this->orderRepository->deleteOrder($id);
    }
}

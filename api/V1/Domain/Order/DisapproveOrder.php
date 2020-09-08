<?php

declare(strict_types = 1);

namespace Borto\Domain\Order;

use Borto\Domain\Order\Entities\OrderEntity;
use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Exceptions\UnableToChangeOrderStatusException;
use Borto\Domain\Order\Repositories\OrderRepository;

class DisapproveOrder
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(int $id): OrderEntity
    {
        $order = $this->orderRepository->getById($id);

        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        if (!in_array($order->getStatusId(), [
            $order::ORDER_QUOTED,
            $order::ORDER_FINISHED,
        ])) {
            throw new UnableToChangeOrderStatusException(
                $order->getStatus(),
                $order::STATUS_NAMES[$order::ORDER_DISAPPROVED]
            );
        }

        $updatedOrder = $this->orderRepository->updateOrder($id, [
            "status" => $order::ORDER_DISAPPROVED
        ]);

        return $updatedOrder;
    }
}

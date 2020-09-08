<?php

declare(strict_types = 1);

namespace Borto\Domain\Order;

use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Repositories\OrderRepository;

class AddInformation
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(int $id, string $dueDate = null): OrderEntity
    {
        $order = $this->orderRepository->getById($id);

        if (empty($order)) {
            throw new OrderNotFoundException();
        }
    }
}

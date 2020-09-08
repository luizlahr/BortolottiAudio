<?php

declare(strict_types = 1);

namespace Borto\Domain\Order;

use Borto\Domain\Order\Entities\OrderEntity;
use Borto\Domain\Order\Entities\OrderRequestEntity;
use Borto\Domain\Order\Repositories\OrderRepository;

class CreateOrderDraft
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(OrderRequestEntity $orderRequest): OrderEntity
    {
        return $this->orderRepository->createOrder($orderRequest);
    }
}

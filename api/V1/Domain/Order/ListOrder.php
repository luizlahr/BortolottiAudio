<?php

declare(strict_types = 1);

namespace Borto\Domain\Order;

use Borto\Domain\Order\Entities\OrderCollection;
use Borto\Domain\Order\Repositories\OrderRepository;

class ListOrder
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(string $filter = null): OrderCollection
    {
        return $this->orderRepository->filter($filter);
    }
}

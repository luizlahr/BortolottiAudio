<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Information;

use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Information\Entities\InformationCollection;
use Borto\Domain\Order\Information\Repositories\InformationRepository;
use Borto\Domain\Order\Repositories\OrderRepository;

class ListInformation
{
    private OrderRepository $orderRepository;
    private InformationRepository $informationRepository;

    public function __construct(OrderRepository $orderRepository, InformationRepository $informationRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->informationRepository = $informationRepository;
    }

    public function execute(int $orderId): InformationCollection
    {
        $order = $this->orderRepository->getById($orderId);

        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        return $this->informationRepository->getByOrderId($orderId);
    }
}

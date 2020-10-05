<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Information;

use Borto\Domain\Order\DTOs\InformationRequestDTO;
use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Information\Entities\InformationEntity;
use Borto\Domain\Order\Information\Repositories\InformationRepository;
use Borto\Domain\Order\Repositories\OrderRepository;

class CreateInformation
{
    private OrderRepository $orderRepository;
    private InformationRepository $informationRepository;

    public function __construct(OrderRepository $orderRepository, InformationRepository $informationRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->informationRepository = $informationRepository;
    }

    public function execute(InformationRequestDTO $informationRequest): InformationEntity
    {
        $order = $this->orderRepository->getById($informationRequest->getOrderId());

        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        return $this->informationRepository->createInformation($informationRequest);
    }
}

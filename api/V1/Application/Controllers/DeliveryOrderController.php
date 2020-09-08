<?php

namespace Borto\Application\Controllers;

use Borto\Domain\Order\DeliveryOrder;
use Illuminate\Http\JsonResponse;

class DeliveryOrderController extends Controller
{
    private DeliveryOrder $deliveryOrder;

    public function __construct(DeliveryOrder $deliveryOrder)
    {
        $this->deliveryOrder = $deliveryOrder;
    }

    public function update(int $order): JsonResponse
    {
        $order = $this->deliveryOrder->execute($order);
        return $this->sendResponse($order->toArray());
    }
}

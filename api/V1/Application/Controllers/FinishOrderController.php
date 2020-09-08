<?php

namespace Borto\Application\Controllers;

use Borto\Domain\Order\FinishOrder;
use Illuminate\Http\JsonResponse;

class FinishOrderController extends Controller
{
    private FinishOrder $finishOrder;

    public function __construct(FinishOrder $finishOrder)
    {
        $this->finishOrder = $finishOrder;
    }

    public function update(int $order): JsonResponse
    {
        $order = $this->finishOrder->execute($order);
        return $this->sendResponse($order->toArray());
    }
}

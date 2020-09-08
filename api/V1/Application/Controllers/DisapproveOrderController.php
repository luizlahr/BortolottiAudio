<?php

namespace Borto\Application\Controllers;

use Borto\Domain\Order\DisapproveOrder;
use Illuminate\Http\JsonResponse;

class DisapproveOrderController extends Controller
{
    private DisapproveOrder $disapproveOrder;

    public function __construct(DisapproveOrder $disapproveOrder)
    {
        $this->disapproveOrder = $disapproveOrder;
    }

    public function update(int $order): JsonResponse
    {
        $order = $this->disapproveOrder->execute($order);
        return $this->sendResponse($order->toArray());
    }
}

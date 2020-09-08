<?php

namespace Borto\Application\Controllers;

use Borto\Domain\Order\MakeOrder;
use Illuminate\Http\JsonResponse;

class MakeOrderController extends Controller
{
    private MakeOrder $makeOrder;

    public function __construct(MakeOrder $makeOrder)
    {
        $this->makeOrder = $makeOrder;
    }

    public function update(int $order): JsonResponse
    {
        $order = $this->makeOrder->execute($order);
        return $this->sendResponse($order->toArray());
    }
}

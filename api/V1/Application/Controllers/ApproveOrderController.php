<?php

namespace Borto\Application\Controllers;

use Borto\Domain\Order\ApproveOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApproveOrderController extends Controller
{
    private ApproveOrder $approveOrder;

    public function __construct(ApproveOrder $approveOrder)
    {
        $this->approveOrder = $approveOrder;
    }

    public function update(int $order, Request $request): JsonResponse
    {
        $dueDate = $request->get('dueDate') ?? null;

        $order = $this->approveOrder->execute($order, $dueDate);
        return $this->sendResponse($order->toArray());
    }
}

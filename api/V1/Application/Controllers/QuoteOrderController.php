<?php

namespace Borto\Application\Controllers;

use Borto\Domain\Order\QuoteOrder;
use Illuminate\Http\JsonResponse;

class QuoteOrderController extends Controller
{
    private QuoteOrder $quoteOrder;

    public function __construct(QuoteOrder $quoteOrder)
    {
        $this->quoteOrder = $quoteOrder;
    }

    public function update(int $order): JsonResponse
    {
        $order = $this->quoteOrder->execute($order);
        return $this->sendResponse($order->toArray());
    }
}

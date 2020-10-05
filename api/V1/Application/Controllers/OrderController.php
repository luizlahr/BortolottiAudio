<?php

namespace Borto\Application\Controllers;

use Borto\Application\Requests\CreateOrderRequest;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Order\CreateOrderDraft;
use Borto\Domain\Order\DeleteOrder;
use Borto\Domain\Order\Entities\OrderRequestEntity;
use Borto\Domain\Order\ListOrder;
use Borto\Domain\Order\Repositories\OrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    use ApiResponse;

    private ListOrder $listOrder;
    private CreateOrderDraft $createOrder;
    private DeleteOrder $deleteOrder;
    private OrderRepository $orderRepository;

    public function __construct(
        ListOrder $listOrder,
        CreateOrderDraft $createOrder,
        DeleteOrder $deleteOrder,
        OrderRepository $orderRepository
    ) {
        $this->listOrder = $listOrder;
        $this->createOrder = $createOrder;
        $this->deleteOrder = $deleteOrder;
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $orders = $this->listOrder->execute($request->search);
        return $this->sendResponse($orders->toArray());
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        $orderRequest = new OrderRequestEntity($request->all());

        $orders = $this->createOrder->execute($orderRequest);
        return $this->sendResponse($orders->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $order): JsonResponse
    {
        $order = $this->orderRepository->getById($order);
        return $this->sendResponse($order->toArray());
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteOrder->execute($id);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}

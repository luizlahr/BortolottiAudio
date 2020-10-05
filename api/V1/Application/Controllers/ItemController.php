<?php

declare(strict_types = 1);

namespace Borto\Application\Controllers;

use Borto\Domain\Order\Item\ListItem;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemController extends Controller
{
    private ListItem $listItem;

    public function __construct(ListItem $listItem)
    {
        $this->listItem = $listItem;
    }

    public function index(int $order): JsonResponse
    {
        $items = $this->listItem->execute($order);
        return $this->sendResponse($items->toArray());
    }

    public function create(): JsonResponse
    {
        return $this->sendResponse([]);
        # code...
    }

    public function update(): JsonResponse
    {
        return $this->sendResponse([]);
        # code...
    }

    public function delete(): JsonResponse
    {
        return $this->sendResponse([]);
        # code...
    }
}

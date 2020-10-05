<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Item;

use Borto\Domain\Order\Exceptions\ItemNotFoundException;
use Borto\Domain\Order\Item\Repositories\ItemRepository;

class DeleteItem
{
    private ItemRepository $informationRepository;

    public function __construct(ItemRepository $informationRepository)
    {
        $this->informationRepository = $informationRepository;
    }

    public function execute(int $id): void
    {
        $item = $this->itemRepository->getById($id);

        if (empty($item)) {
            throw new ItemNotFoundException();
        }

        $this->itemRepository->deleteItem($id);
    }
}

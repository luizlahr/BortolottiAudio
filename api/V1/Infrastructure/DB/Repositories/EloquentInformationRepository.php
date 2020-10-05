<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\DB\Repositories;

use Borto\Domain\Order\DTOs\InformationRequestDTO;
use Borto\Domain\Order\Exceptions\InformationNotFoundException;
use Borto\Domain\Order\Information\Entities\InformationCollection;
use Borto\Domain\Order\Information\Entities\InformationEntity;
use Borto\Domain\Order\Information\Repositories\InformationRepository;
use Borto\Infrastructure\DB\Models\Information;
use Illuminate\Database\Eloquent\Collection;

class EloquentInformationRepository implements InformationRepository
{
    private Information $information;

    public function __construct()
    {
        $this->information = new Information();
    }

    public function getByOrderId(int $orderId): InformationCollection
    {
        $informations = $this->information->where('order_id', $orderId)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $this->makeCollection($informations);
    }

    public function getById(int $id): ?InformationEntity
    {
        $information = $this->information->find($id);

        if (empty($information)) {
            return null;
        }

        return $information->toEntity();
    }

    public function createInformation(InformationRequestDTO $informationRequest): InformationEntity
    {
        $information = $this->information->create($informationRequest->toArray());
        return $information->toEntity();
    }

    public function deleteInformation(int $id): void
    {
        $information = $this->information->find($id);

        if (empty($information)) {
            throw new InformationNotFoundException();
        }

        $information->delete();
    }

    private function makeCollection(Collection $informations): InformationCollection
    {
        $collection = new InformationCollection();
        $collection->fill($informations->all());

        return $collection;
    }
}

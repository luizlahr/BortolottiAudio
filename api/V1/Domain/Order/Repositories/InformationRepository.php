<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Repositories;

use Borto\Domain\Order\DTOs\InformationRequestDTO;
use Borto\Domain\Order\Entities\InformationCollection;
use Borto\Domain\Order\Entities\InformationEntity;

interface InformationRepository
{
    public function getByOrderId(int $orderId): InformationCollection;
    public function getById(int $id): ?InformationEntity;
    public function createInformation(InformationRequestDTO $informationRequest): InformationEntity;
    public function deleteInformation(int $id): void;
}

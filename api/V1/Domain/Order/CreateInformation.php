<?php

declare(strict_types = 1);

namespace Borto\Domain\Order;

use Borto\Domain\Order\DTOs\InformationRequestDTO;
use Borto\Domain\Order\Entities\InformationEntity;
use Borto\Domain\Order\Repositories\InformationRepository;

class CreateInformation
{
    private InformationRepository $informationRepository;

    public function __construct(InformationRepository $informationRepository)
    {
        $this->informationRepository = $informationRepository;
    }

    public function execute(InformationRequestDTO $informationRequest): InformationEntity
    {
        return $this->informationRepository->createInformation($informationRequest);
    }
}

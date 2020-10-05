<?php

declare(strict_types = 1);

namespace Borto\Domain\Order\Information;

use Borto\Domain\Order\Exceptions\InformationNotFoundException;
use Borto\Domain\Order\Exceptions\UnableToDeleteSystemInformationException;
use Borto\Domain\Order\Information\Entities\InformationEntity;
use Borto\Domain\Order\Information\Repositories\InformationRepository;

class DeleteInformation
{
    private InformationRepository $informationRepository;

    public function __construct(InformationRepository $informationRepository)
    {
        $this->informationRepository = $informationRepository;
    }

    public function execute(int $id): void
    {
        $information = $this->informationRepository->getById($id);

        if (empty($information)) {
            throw new InformationNotFoundException();
        }

        if ($information->getType() === InformationEntity::TYPE_SYSTEM) {
            throw new UnableToDeleteSystemInformationException();
        }

        $this->informationRepository->deleteInformation($id);
    }
}

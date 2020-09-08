<?php

declare(strict_types = 1);

namespace Borto\Domain\Order;

use Borto\Domain\Order\Entities\InformationEntity;
use Borto\Domain\Order\Exceptions\InformationNotFoundException;
use Borto\Domain\Order\Exceptions\UnableToDeleteSystemInformationException;
use Borto\Domain\Order\Repositories\InformationRepository;

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

        if ($information->type === InformationEntity::TYPE_SYSTEM) {
            throw new UnableToDeleteSystemInformationException();
        }

        $this->informationRepository->deleteInformation($id);
    }
}

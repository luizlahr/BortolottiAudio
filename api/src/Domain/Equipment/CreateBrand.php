<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Domain\Equipment\Entities\BrandRequestEntity;
use Borto\Domain\Equipment\Exceptions\DuplicatedBrandException;
use Borto\Domain\Equipment\Repository\BrandRepository;

class CreateBrand
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function handle(BrandRequestEntity $brandData): BrandEntity
    {
        $brand = $this->brandRepository->getByName($brandData->getName());

        if (!empty($brand)) {
            throw new DuplicatedBrandException();
        }

        return $this->brandRepository->createBrand($brandData->toArray());
    }
}

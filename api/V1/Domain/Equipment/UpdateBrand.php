<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Domain\Equipment\Entities\BrandRequestEntity;
use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\Exceptions\DuplicatedBrandException;
use Borto\Domain\Equipment\Repositories\BrandRepository;

class UpdateBrand
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function handle(int $id, BrandRequestEntity $brandData): BrandEntity
    {
        $brand = $this->brandRepository->getById($id);

        if (!$brand) {
            throw new BrandNotFoundException();
        }

        $existingBrand = $this->brandRepository->getByName($brandData->getName());
        if ($existingBrand && $existingBrand->getId() !== $id) {
            throw new DuplicatedBrandException();
        }

        return $this->brandRepository->updateBrand($id, $brandData->toArray());
    }
}

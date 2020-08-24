<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\Repositories\BrandRepository;

class DeleteBrand
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function handle(int $id): void
    {
        $brand = $this->brandRepository->getById($id);

        if (!$brand) {
            throw new BrandNotFoundException();
        }

        $this->brandRepository->deleteBrand($id);
    }
}

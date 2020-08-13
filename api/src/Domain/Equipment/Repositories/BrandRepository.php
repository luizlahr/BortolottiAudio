<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Repository;

use Borto\Domain\Equipment\Entities\BrandCollection;
use Borto\Domain\Equipment\Entities\BrandEntity;

interface BrandRepository
{
    public function getAll(): BrandCollection;
    public function getById(int $id): ?BrandEntity;
    public function getByName(string $email): ?BrandEntity;
    public function createBrand(array $brandData): BrandEntity;
    public function updateBrand(int $id, array $brandData): BrandEntity;
    public function deleteBrand(int $id): void;
}

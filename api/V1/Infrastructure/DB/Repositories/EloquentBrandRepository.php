<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\DB\Repositories;

use Borto\Domain\Equipment\Entities\BrandCollection;
use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\Repositories\BrandRepository;
use Borto\Infrastructure\DB\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class EloquentBrandRepository implements BrandRepository
{
    private Brand $brand;

    public function __construct()
    {
        $this->brand = new Brand();
    }

    public function getAll(): BrandCollection
    {
        $brands = $this->brand->orderBy('name', 'asc')->get();
        return $this->makeCollection($brands);
    }

    public function getById(int $id): ?BrandEntity
    {
        $brand = $this->brand->find($id);

        return Optional($brand)->toEntity() ?? null;
    }

    public function getByName(string $name): ?BrandEntity
    {
        $brand = $this->brand->where('name', $name)->first();

        return Optional($brand)->toEntity() ?? null;
    }

    public function createBrand(array $brandData): BrandEntity
    {
        $brand = $this->brand->create($brandData);
        return $brand->toEntity();
    }

    public function updateBrand(int $id, array $brandData): BrandEntity
    {
        $brand = $this->brand->find($id);

        if (!$brand) {
            throw new BrandNotFoundException();
        }

        $brand->update($brandData);
        return $brand->toEntity();
    }

    public function deleteBrand(int $id): void
    {
        $brand = $this->brand->find($id);

        if (!$brand) {
            throw new BrandNotFoundException();
        }

        $brand->delete();
    }

    /** @param Collection<Brand> $brands */
    public function makeCollection(Collection $brands)
    {
        $brandList = new BrandCollection();
        foreach ($brands as $brand) {
            $brandList->add($brand->toEntity());
        }
        return $brandList;
    }
}

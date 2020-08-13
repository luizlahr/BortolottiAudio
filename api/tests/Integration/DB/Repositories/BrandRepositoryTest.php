<?php

declare(strict_types = 1);

namespace Tests\Integration\DB\Repositories;

use Borto\Domain\Equipment\Entities\BrandCollection;
use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\Repository\BrandRepository;
use Borto\Infrastructure\DB\Models\Brand;
use Borto\Infrastructure\DB\Repositories\EloquentBrandRepository;
use Tests\TestCase;

class BrandRepositoryTest extends TestCase
{
    public function testItImplementBrandRepository()
    {
        $repository = $this->getRepository();
        $this->assertInstanceOf(BrandRepository::class, $repository);
    }

    public function testItCanGetAll()
    {
        $amount = $this->faker->numberBetween(1, 10);
        factory(Brand::class, $amount)->create();

        $repository = $this->getRepository();
        $response = $repository->getAll();

        $this->assertInstanceOf(BrandCollection::class, $response);
        $this->assertEquals($response->count(), $amount);
    }

    public function testItCanGetById()
    {
        $brand = factory(Brand::class)->create();
        $entity = $this->makeBrandEntity($brand);

        $repository = $this->getRepository();
        $response = $repository->getById($brand->id);
        $this->assertInstanceOf(BrandEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetByWrongId()
    {
        $brand = factory(Brand::class)->create();
        $wrongId = $brand->id + 1;

        $repository = $this->getRepository();
        $response = $repository->getById($wrongId);
        $this->assertEquals($response, null);
    }

    public function testItCanGetByName()
    {
        $brand = factory(Brand::class)->create();
        $entity = $this->makeBrandEntity($brand);

        $repository = $this->getRepository();
        $response = $repository->getByName($brand->name);
        $this->assertInstanceOf(BrandEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetByWrongName()
    {
        $brand = factory(Brand::class)->create();
        $wrongName = "wrong-" . $brand->name;

        $repository = $this->getRepository();
        $response = $repository->getByName($wrongName);
        $this->assertEquals($response, null);
    }

    public function testItCanCreateAnBrand()
    {
        $name = $this->faker->word;

        $repository = $this->getRepository();
        $repository->createBrand([
            "name" => $name,
        ]);

        $this->assertDatabaseHas('brands', [
            "name" => $name,
        ]);
    }

    public function testItCanUpdateAnExistingBrand()
    {
        $brand = factory(Brand::class)->create();

        $name = $this->faker->word;

        $repository = $this->getRepository();
        $repository->updateBrand($brand->id, [
            "name" => $name,
        ]);

        $this->assertDatabaseHas('brands', [
            "id"   => $brand->id,
            "name" => $name,
        ]);
    }

    public function testItCanNotUpdateAnUnexistingBrand()
    {
        $brand = factory(Brand::class)->create();
        $wrongId = $brand->id + 1;

        $name = $this->faker->word;

        $repository = $this->getRepository();
        $this->expectException(BrandNotFoundException::class);
        $repository->updateBrand($wrongId, [
            "name" => $name,
        ]);
    }

    public function testItCanDeleteAnExistingBrand()
    {
        $brand = factory(Brand::class)->create();

        $repository = $this->getRepository();
        $repository->deleteBrand($brand->id);

        $this->assertDatabaseMissing('brands', [
            "id" => $brand->id,
        ]);
    }

    public function testItCanNotDeleteAnUnexistingBrand()
    {
        $brand = factory(Brand::class)->create();
        $wrongId = $brand->id + 1;

        $repository = $this->getRepository();
        $this->expectException(BrandNotFoundException::class);
        $repository->deleteBrand($wrongId);
        $this->assertDatabaseHas('brands', [
            "id" => $brand->id,
        ]);
    }

    private function getRepository(): BrandRepository
    {
        $model = new Brand();
        return new EloquentBrandRepository($model);
    }

    private function makeBrandEntity(Brand $brand): BrandEntity
    {
        return new BrandEntity(
            $brand->id,
            $brand->name,
        );
    }
}

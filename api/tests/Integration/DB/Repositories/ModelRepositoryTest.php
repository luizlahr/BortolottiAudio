<?php

declare(strict_types = 1);

namespace Tests\Integration\DB\Repositories;

use Borto\Domain\Equipment\Entities\ModelCollection;
use Borto\Domain\Equipment\Entities\ModelEntity;
use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Exceptions\ModelNotFoundException;
use Borto\Domain\Equipment\Repositories\ModelRepository;
use Borto\Infrastructure\DB\Models\Brand;
use Borto\Infrastructure\DB\Models\Category;
use Borto\Infrastructure\DB\Models\Model;
use Borto\Infrastructure\DB\Repositories\EloquentModelRepository;
use Tests\TestCase;

class ModelRepositoryTest extends TestCase
{
    public function testItImplementModelRepository()
    {
        $repository = $this->getRepository();
        $this->assertInstanceOf(ModelRepository::class, $repository);
    }

    public function testItCanGetAll()
    {
        $amount = $this->faker->numberBetween(1, 10);
        factory(Model::class, $amount)->create();

        $repository = $this->getRepository();
        $response = $repository->getAll();

        $this->assertInstanceOf(ModelCollection::class, $response);
        $this->assertEquals($response->count(), $amount);
    }

    public function testItCanGetById()
    {
        $model = factory(Model::class)->create();
        $entity = $model->toEntity();

        $repository = $this->getRepository();
        $response = $repository->getById($model->id);
        $this->assertInstanceOf(ModelEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetByWrongId()
    {
        $model = factory(Model::class)->create();
        $wrongId = $model->id + 1;

        $repository = $this->getRepository();
        $response = $repository->getById($wrongId);

        $this->assertEquals($response, null);
    }

    public function testItCanGetByName(): void
    {
        $model = factory(Model::class)->create();
        $entity = $model->toEntity();

        $repository = $this->getRepository();
        $response = $repository->getByName($model->name);

        $this->assertInstanceOf(ModelEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetByWrongName(): void
    {
        $model = factory(Model::class)->create();
        $wrongName = "wrong-" . $model->name;

        $repository = $this->getRepository();
        $response = $repository->getByName($wrongName);
        $this->assertEquals($response, null);
    }

    public function testItCanCreateAnModel(): void
    {
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();
        $name = $this->faker->word;
        $categoryId = $category->id;
        $brandId = $brand->id;

        $repository = $this->getRepository();
        $response = $repository->createModel([
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
        ]);

        $this->assertInstanceOf(ModelEntity::class, $response);
        $this->assertDatabaseHas('models', [
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
        ]);
    }

    public function testItValidatesIfCategoryIdExist(): void
    {
        $brand = factory(Brand::class)->create();
        $name = $this->faker->word;
        $categoryId = $this->randomId();
        $brandId = $brand->id;

        $repository = $this->getRepository();
        $this->expectException(CategoryNotFoundException::class);
        $repository->createModel([
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
        ]);
    }

    public function testItValidatesIfBrandIdExist(): void
    {
        $category = factory(Category::class)->create();
        $name = $this->faker->word;
        $categoryId = $category->id;
        $brandId = $this->randomId();

        $repository = $this->getRepository();
        $this->expectException(BrandNotFoundException::class);
        $repository->createModel([
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
        ]);
    }

    public function testItCanUpdateAnExistingModel(): void
    {
        $model = factory(Model::class)->create();
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();

        $categoryId = $category->id;
        $brandId = $brand->id;
        $name = $this->faker->word;

        $repository = $this->getRepository();
        $response = $repository->updateModel($model->id, [
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
        ]);

        $this->assertInstanceOf(ModelEntity::class, $response);

        $this->assertDatabaseHas('models', [
            "id"          => $model->id,
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
        ]);
    }

    public function testItCanNotUpdateAnUnexistingModel(): void
    {
        $model = factory(Model::class)->create();
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();
        $wrongId = $model->id + 1;

        $categoryId = $category->id;
        $brandId = $brand->id;
        $name = $this->faker->word;

        $repository = $this->getRepository();
        $this->expectException(ModelNotFoundException::class);
        $repository->updateModel($wrongId, [
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
        ]);
    }

    public function testItCanDeleteAnExistingModel(): void
    {
        $model = factory(Model::class)->create();

        $repository = $this->getRepository();
        $repository->deleteModel($model->id);

        $this->assertDatabaseMissing('models', [
            "id" => $model->id,
        ]);
    }

    public function testItCanNotDeleteAnUnexistingModel(): void
    {
        $model = factory(Model::class)->create();
        $wrongId = $model->id + 1;

        $repository = $this->getRepository();
        $this->expectException(ModelNotFoundException::class);
        $repository->deleteModel($wrongId);

        $this->assertDatabaseHas('models', [
            "id" => $model->id,
        ]);
    }

    private function getRepository(): ModelRepository
    {
        $model = new Model();
        return new EloquentModelRepository($model);
    }
}

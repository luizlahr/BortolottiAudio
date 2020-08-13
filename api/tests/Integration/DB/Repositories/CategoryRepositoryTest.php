<?php

declare(strict_types = 1);

namespace Tests\Integration\DB\Repositories;

use Borto\Domain\Equipment\Entities\CategoryCollection;
use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Repository\CategoryRepository;
use Borto\Infrastructure\DB\Models\Category;
use Borto\Infrastructure\DB\Repositories\EloquentCategoryRepository;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    public function testItImplementCategoryRepository()
    {
        $repository = $this->getRepository();
        $this->assertInstanceOf(CategoryRepository::class, $repository);
    }

    public function testItCanGetAll()
    {
        $amount = $this->faker->numberBetween(1, 10);
        factory(Category::class, $amount)->create();

        $repository = $this->getRepository();
        $response = $repository->getAll();

        $this->assertInstanceOf(CategoryCollection::class, $response);
        $this->assertEquals($response->count(), $amount);
    }

    public function testItCanGetById()
    {
        $category = factory(Category::class)->create();
        $entity = $this->makeCategoryEntity($category);

        $repository = $this->getRepository();
        $response = $repository->getById($category->id);
        $this->assertInstanceOf(CategoryEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetByWrongId()
    {
        $category = factory(Category::class)->create();
        $wrongId = $category->id + 1;

        $repository = $this->getRepository();
        $response = $repository->getById($wrongId);
        $this->assertEquals($response, null);
    }

    public function testItCanGetByName()
    {
        $category = factory(Category::class)->create();
        $entity = $this->makeCategoryEntity($category);

        $repository = $this->getRepository();
        $response = $repository->getByName($category->name);
        $this->assertInstanceOf(CategoryEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetByWrongName()
    {
        $category = factory(Category::class)->create();
        $wrongName = "wrong-" . $category->name;

        $repository = $this->getRepository();
        $response = $repository->getByName($wrongName);
        $this->assertEquals($response, null);
    }

    public function testItCanCreateAnCategory()
    {
        $name = $this->faker->word;

        $repository = $this->getRepository();
        $repository->createCategory([
            "name" => $name,
        ]);

        $this->assertDatabaseHas('categories', [
            "name" => $name,
        ]);
    }

    public function testItCanUpdateAnExistingCategory()
    {
        $category = factory(Category::class)->create();

        $name = $this->faker->word;

        $repository = $this->getRepository();
        $repository->updateCategory($category->id, [
            "name" => $name,
        ]);

        $this->assertDatabaseHas('categories', [
            "id"   => $category->id,
            "name" => $name,
        ]);
    }

    public function testItCanNotUpdateAnUnexistingCategory()
    {
        $category = factory(Category::class)->create();
        $wrongId = $category->id + 1;

        $name = $this->faker->word;

        $repository = $this->getRepository();
        $this->expectException(CategoryNotFoundException::class);
        $repository->updateCategory($wrongId, [
            "name" => $name,
        ]);
    }

    public function testItCanDeleteAnExistingCategory()
    {
        $category = factory(Category::class)->create();

        $repository = $this->getRepository();
        $repository->deleteCategory($category->id);

        $this->assertDatabaseMissing('categories', [
            "id" => $category->id,
        ]);
    }

    public function testItCanNotDeleteAnUnexistingCategory()
    {
        $category = factory(Category::class)->create();
        $wrongId = $category->id + 1;

        $repository = $this->getRepository();
        $this->expectException(CategoryNotFoundException::class);
        $repository->deleteCategory($wrongId);
        $this->assertDatabaseHas('categories', [
            "id" => $category->id,
        ]);
    }

    private function getRepository(): CategoryRepository
    {
        $model = new Category();
        return new EloquentCategoryRepository($model);
    }

    private function makeCategoryEntity(Category $category): CategoryEntity
    {
        return new CategoryEntity(
            $category->id,
            $category->name,
        );
    }
}

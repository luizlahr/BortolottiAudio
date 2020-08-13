<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Borto\Domain\Equipment\Entities\CategoryRequestEntity;
use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Exceptions\DuplicatedCategoryException;
use Borto\Domain\Equipment\Repository\CategoryRepository;
use Borto\Domain\Equipment\UpdateCategory;
use Borto\Infrastructure\DB\Repositories\EloquentCategoryRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class UpdateCategoryTest extends BaseTestCase
{
    /** @var CategoryRepository|MockObject $userRepository */
    private $categoryRepository;

    public function setup(): void
    {
        parent::setup();

        $this->categoryRepository = $this->createMock(EloquentCategoryRepository::class);
    }

    public function testItCanUpdateACategory()
    {
        $category = $this->makeCategories();
        $categoryRequest = new CategoryRequestEntity([
            "name" => $category->getName()
        ]);

        $this->categoryRepository->expects($this->once())
            ->method('getById')
            ->willReturn($category);

        $this->categoryRepository->expects($this->once())
            ->method('getByName')
            ->willReturn(null);

        $this->categoryRepository->expects($this->once())
            ->method('updateCategory')
            ->willReturn($category);

        $service = $this->getService();
        $response = $service->handle($category->getId(), $categoryRequest);

        $this->assertEquals($response, $category);
    }

    public function testItCanNotUpdateACategoryWithDuplicatedName()
    {
        $name = $this->faker->word;
        $category = $this->makeCategories();
        $existingCategory = $this->makeCategories(1, false, ["name" => $name]);

        $categoryRequest = new CategoryRequestEntity([
            "name" => $name,
        ]);

        $this->categoryRepository->expects($this->once())
            ->method('getById')
            ->willReturn($category);

        $this->categoryRepository->expects($this->once())
            ->method('getByName')
            ->willReturn($existingCategory);

        $service = $this->getService();

        $this->expectException(DuplicatedCategoryException::class);
        $service->handle($category->getId(), $categoryRequest);
    }

    public function testItCanNotUpdateAnUnexistingCategory()
    {
        $wrongId = $this->randomId();
        $categoryRequest = new CategoryRequestEntity([
            "name" => $this->faker->name
        ]);

        $this->categoryRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $service = $this->getService();

        $this->expectException(CategoryNotFoundException::class);
        $service->handle($wrongId, $categoryRequest);
    }

    public function getService(): UpdateCategory
    {
        return new UpdateCategory($this->categoryRepository);
    }
}

<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment;

use Borto\Domain\Equipment\CreateCategory;
use Borto\Domain\Equipment\Entities\CategoryRequestEntity;
use Borto\Domain\Equipment\Exceptions\DuplicatedCategoryException;
use Borto\Domain\Equipment\Repositories\CategoryRepository;
use Borto\Infrastructure\DB\Repositories\EloquentCategoryRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class CreateCategoryTest extends BaseTestCase
{
    /** @var CategoryRepository|MockObject $categoryRepository */
    private $categoryRepository;

    public function setup(): void
    {
        parent::setup();

        $this->categoryRepository = $this->createMock(EloquentCategoryRepository::class);
    }

    public function testItCanCreateACategory()
    {
        $category = $this->makeCategories();
        $categoryRequest = new CategoryRequestEntity([
            "name" => $category->getName()
        ]);

        $this->categoryRepository->expects($this->once())
            ->method('getByName')
            ->willReturn(null);

        $this->categoryRepository->expects($this->once())
            ->method('createCategory')
            ->willReturn($category);

        $service = $this->getService();
        $response = $service->handle($categoryRequest);

        $this->assertEquals($response, $category);
    }

    public function testItCanNotCreateAnUserWithDuplicatedEmail()
    {
        $category = $this->makeCategories();
        $existingCategory = $this->makeCategories();
        $categoryRequest = new CategoryRequestEntity([
            "name" => $category->getName(),
        ]);

        $this->categoryRepository->expects($this->once())
            ->method('getByName')
            ->willReturn($existingCategory);

        $service = $this->getService();

        $this->expectException(DuplicatedCategoryException::class);
        $service->handle($categoryRequest);
    }

    public function getService(): CreateCategory
    {
        return new CreateCategory($this->categoryRepository);
    }
}

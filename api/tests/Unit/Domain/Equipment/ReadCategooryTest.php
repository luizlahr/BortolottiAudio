<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\ReadCategory;
use Borto\Domain\Equipment\Repository\CategoryRepository;
use Borto\Infrastructure\DB\Repositories\EloquentCategoryRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class ReadCategooryTest extends BaseTestCase
{
    /** @var CategoryRepository|MockObject $userRepository */
    private $categoryRepository;

    public function setup(): void
    {
        parent::setup();

        $this->categoryRepository = $this->createMock(EloquentCategoryRepository::class);
    }

    public function testItCanReadACategory()
    {
        $category = $this->makeCategories();

        $this->categoryRepository->expects($this->once())
            ->method('getById')
            ->willReturn($category);

        $service = $this->getService();
        $response = $service->handle($this->randomId());
        $this->assertEquals($response, $category);
    }

    public function testItCanNotReadAnUnexistingUser()
    {
        $this->categoryRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $service = $this->getService();

        $this->expectException(CategoryNotFoundException::class);
        $service->handle($this->randomId());
    }

    public function getService(): ReadCategory
    {
        return new ReadCategory($this->categoryRepository);
    }
}

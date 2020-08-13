<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Equipment\Entities\CategoryRequestEntity;
use Borto\Domain\Equipment\Exceptions\DuplicatedCategoryException;
use Borto\Domain\Equipment\Repository\CategoryRepository;

class CreateCategory
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(CategoryRequestEntity $categoryData): CategoryEntity
    {
        $category = $this->categoryRepository->getByName($categoryData->getName());

        if (!empty($category)) {
            throw new DuplicatedCategoryException();
        }

        return $this->categoryRepository->createCategory($categoryData->toArray());
    }
}

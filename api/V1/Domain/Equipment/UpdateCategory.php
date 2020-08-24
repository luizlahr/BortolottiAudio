<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Equipment\Entities\CategoryRequestEntity;
use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Exceptions\DuplicatedCategoryException;
use Borto\Domain\Equipment\Repositories\CategoryRepository;

class UpdateCategory
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(int $id, CategoryRequestEntity $categoryData): CategoryEntity
    {
        $category = $this->categoryRepository->getById($id);

        if (!$category) {
            throw new CategoryNotFoundException();
        }

        $existingCategory = $this->categoryRepository->getByName($categoryData->getName());
        if ($existingCategory && $existingCategory->getId() !== $id) {
            throw new DuplicatedCategoryException();
        }

        return $this->categoryRepository->updateCategory($id, $categoryData->toArray());
    }
}

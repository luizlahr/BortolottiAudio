<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Repository\CategoryRepository;

class ReadCategory
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(int $id): CategoryEntity
    {
        $category = $this->categoryRepository->getById($id);

        if (!$category) {
            throw new CategoryNotFoundException();
        }

        return $category;
    }
}

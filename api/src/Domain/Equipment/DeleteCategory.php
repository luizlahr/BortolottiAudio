<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Repositories\CategoryRepository;

class DeleteCategory
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(int $id): void
    {
        $category = $this->categoryRepository->getById($id);

        if (!$category) {
            throw new CategoryNotFoundException();
        }

        $this->categoryRepository->deleteCategory($id);
    }
}

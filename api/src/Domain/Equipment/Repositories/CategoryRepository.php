<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Repositories;

use Borto\Domain\Equipment\Entities\CategoryCollection;
use Borto\Domain\Equipment\Entities\CategoryEntity;

interface CategoryRepository
{
    public function getAll(): CategoryCollection;
    public function getById(int $id): ?CategoryEntity;
    public function getByName(string $email): ?CategoryEntity;
    public function createCategory(array $categoryData): CategoryEntity;
    public function updateCategory(int $id, array $categoryData): CategoryEntity;
    public function deleteCategory(int $id): void;
}

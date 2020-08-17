<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\DB\Repositories;

use Borto\Domain\Equipment\Entities\CategoryCollection;
use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Repositories\CategoryRepository;
use Borto\Infrastructure\DB\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class EloquentCategoryRepository implements CategoryRepository
{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function getAll(): CategoryCollection
    {
        $categories = $this->category->orderBy('name', 'asc')->get();
        return $this->makeCollection($categories);
    }

    public function getById(int $id): ?CategoryEntity
    {
        $category = $this->category->find($id);

        if (!$category) {
            return null;
        }

        return $this->makeEntity($category);
    }

    public function getByName(string $name): ?CategoryEntity
    {
        $category = $this->category->where('name', $name)->first();

        if (!$category) {
            return null;
        }

        return $this->makeEntity($category);
    }

    public function createCategory(array $categoryData): CategoryEntity
    {
        $category = $this->category->create($categoryData);
        return $this->makeEntity($category);
    }

    public function updateCategory(int $id, array $categoryData): CategoryEntity
    {
        $category = $this->category->find($id);

        if (!$category) {
            throw new CategoryNotFoundException();
        }

        $category->update($categoryData);
        return $this->makeEntity($category);
    }

    public function deleteCategory(int $id): void
    {
        $category = $this->category->find($id);

        if (!$category) {
            throw new CategoryNotFoundException();
        }

        $category->delete();
    }

    /** @param Collection<Category> $categories */
    public function makeCollection(Collection $categories)
    {
        $categoryList = new CategoryCollection();
        foreach ($categories as $category) {
            $categoryList->add($this->makeEntity($category));
        }
        return $categoryList;
    }

    public function makeEntity(Category $category): CategoryEntity
    {
        return new CategoryEntity(
            $category->id,
            $category->name,
        );
    }
}

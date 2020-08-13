<?php

namespace Borto\Application\Controllers;

use Borto\Application\Requests\CreateCategoryRequest;
use Borto\Application\Requests\UpdateCategoryRequest;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Equipment\CreateCategory;
use Borto\Domain\Equipment\DeleteCategory;
use Borto\Domain\Equipment\Entities\CategoryRequestEntity;
use Borto\Domain\Equipment\ReadCategory;
use Borto\Domain\Equipment\Repository\CategoryRepository;
use Borto\Domain\Equipment\UpdateCategory;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    use ApiResponse;

    private CreateCategory $createCategory;
    private UpdateCategory $updateCategory;
    private ReadCategory $readCategory;
    private DeleteCategory $deleteCategory;
    private CategoryRepository $categoryRepository;

    public function __construct(
        CreateCategory $createCategory,
        UpdateCategory $updateCategory,
        ReadCategory $readCategory,
        DeleteCategory $deleteCategory,
        CategoryRepository $categoryRepository
    ) {
        $this->createCategory = $createCategory;
        $this->updateCategory = $updateCategory;
        $this->readCategory = $readCategory;
        $this->deleteCategory = $deleteCategory;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return $this->sendResponse($categories->toArray());
    }

    public function store(CreateCategoryRequest $request)
    {
        $categoryRequest = new CategoryRequestEntity($request->all());

        $category = $this->createCategory->handle($categoryRequest);
        return $this->sendResponse($category->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $category = $this->readCategory->handle($id);

        return $this->sendResponse($category->toArray());
    }

    public function update(int $id, UpdateCategoryRequest $request)
    {
        $categoryRequest = new CategoryRequestEntity($request->all());

        $category = $this->updateCategory->handle($id, $categoryRequest);
        return $this->sendResponse($category->toArray());
    }

    public function destroy(int $id)
    {
        $this->deleteCategory->handle($id);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}

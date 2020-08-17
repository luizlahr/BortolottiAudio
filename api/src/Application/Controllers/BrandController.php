<?php

namespace Borto\Application\Controllers;

use Borto\Application\Requests\CreateBrandRequest;
use Borto\Application\Requests\UpdateBrandRequest;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Equipment\CreateBrand;
use Borto\Domain\Equipment\DeleteBrand;
use Borto\Domain\Equipment\Entities\BrandRequestEntity;
use Borto\Domain\Equipment\ReadBrand;
use Borto\Domain\Equipment\Repositories\BrandRepository;
use Borto\Domain\Equipment\UpdateBrand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    use ApiResponse;

    private CreateBrand $createBrand;
    private UpdateBrand $updateBrand;
    private ReadBrand $readBrand;
    private DeleteBrand $deleteBrand;
    private BrandRepository $brandRepository;

    public function __construct(
        CreateBrand $createBrand,
        UpdateBrand $updateBrand,
        ReadBrand $readBrand,
        DeleteBrand $deleteBrand,
        BrandRepository $brandRepository
    ) {
        $this->createBrand = $createBrand;
        $this->updateBrand = $updateBrand;
        $this->readBrand = $readBrand;
        $this->deleteBrand = $deleteBrand;
        $this->brandRepository = $brandRepository;
    }

    public function index(): JsonResponse
    {
        $brands = $this->brandRepository->getAll();
        return $this->sendResponse($brands->toArray());
    }

    public function store(CreateBrandRequest $request): JsonResponse
    {
        $brandRequest = new BrandRequestEntity($request->all());

        $brand = $this->createBrand->handle($brandRequest);
        return $this->sendResponse($brand->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $brand = $this->readBrand->handle($id);

        return $this->sendResponse($brand->toArray());
    }

    public function update(int $id, UpdateBrandRequest $request): JsonResponse
    {
        $brandRequest = new BrandRequestEntity($request->all());

        $brand = $this->updateBrand->handle($id, $brandRequest);
        return $this->sendResponse($brand->toArray());
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteBrand->handle($id);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}

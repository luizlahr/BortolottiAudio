<?php

declare(strict_types = 1);

namespace Borto\Application\Controllers;

use Borto\Application\Requests\CreateModelRequest;
use Borto\Application\Requests\UpdateModelRequest;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Equipment\CreateModel;
use Borto\Domain\Equipment\DeleteModel;
use Borto\Domain\Equipment\Entities\ModelRequestEntity;
use Borto\Domain\Equipment\ReadModel;
use Borto\Domain\Equipment\Repositories\ModelRepository;
use Borto\Domain\Equipment\UpdateModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ModelController extends Controller
{
    use ApiResponse;

    private ModelRepository $modelRepository;
    private CreateModel $createModel;
    private UpdateModel $updateModel;
    private ReadModel $readModel;
    private DeleteModel $deleteModel;

    public function __construct(
        ModelRepository $modelRepository,
        CreateModel $createModel,
        UpdateModel $updateModel,
        ReadModel $readModel,
        DeleteModel $deleteModel
    ) {
        $this->createModel = $createModel;
        $this->updateModel = $updateModel;
        $this->readModel = $readModel;
        $this->deleteModel = $deleteModel;
        $this->modelRepository = $modelRepository;
    }

    public function index(): JsonResponse
    {
        $models = $this->modelRepository->getAll();
        return $this->sendResponse($models->toArray());
    }

    public function store(CreateModelRequest $request): JsonResponse
    {
        $modelRequest = new ModelRequestEntity($request->all());
        $model = $this->createModel->handle($modelRequest);
        return $this->sendResponse($model->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $model = $this->readModel->handle($id);
        return $this->sendResponse($model->toArray());
    }

    public function update(int $id, UpdateModelRequest $request): JsonResponse
    {
        $modelRequest = new ModelRequestEntity($request->all());
        $model = $this->updateModel->handle($id, $modelRequest);
        return $this->sendResponse($model->toArray());
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteModel->handle($id);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}

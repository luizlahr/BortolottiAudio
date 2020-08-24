<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Entities\ModelEntity;
use Borto\Domain\Equipment\Entities\ModelRequestEntity;
use Borto\Domain\Equipment\Exceptions\DuplicatedModelException;
use Borto\Domain\Equipment\Exceptions\ModelNotFoundException;
use Borto\Domain\Equipment\Repositories\ModelRepository;

class UpdateModel
{
    private ModelRepository $modelRepository;

    public function __construct(ModelRepository $modelRepository)
    {
        $this->modelRepository = $modelRepository;
    }

    public function handle(int $id, ModelRequestEntity $modelData): ModelEntity
    {
        $model = $this->modelRepository->getById($id);

        if (!$model) {
            throw new ModelNotFoundException();
        }

        $existingModel = $this->modelRepository->getByName($modelData->getName());
        if ($existingModel &&
            $modelData->getCategoryId() === $existingModel->getCategoryId() &&
            $modelData->getBrandId() === $existingModel->getBrandId() &&
            $existingModel->getId() !== $id
        ) {
            throw new DuplicatedModelException();
        }

        return $this->modelRepository->updateModel($id, $modelData->toArray());
    }
}

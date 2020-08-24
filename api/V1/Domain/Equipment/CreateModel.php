<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Entities\ModelEntity;
use Borto\Domain\Equipment\Entities\ModelRequestEntity;
use Borto\Domain\Equipment\Exceptions\DuplicatedModelException;
use Borto\Domain\Equipment\Repositories\ModelRepository;

class CreateModel
{
    private ModelRepository $modelRepository;

    public function __construct(ModelRepository $modelRepository)
    {
        $this->modelRepository = $modelRepository;
    }

    public function handle(ModelRequestEntity $modelData): ModelEntity
    {
        $model = $this->modelRepository->getByName($modelData->getName());

        if (!empty($model) &&
            $modelData->getCategoryId() === $model->getCategoryId() &&
            $modelData->getBrandId() === $model->getBrandId()
        ) {
            throw new DuplicatedModelException();
        }

        return $this->modelRepository->createModel($modelData->toArray());
    }
}

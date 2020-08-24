<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Entities\ModelEntity;
use Borto\Domain\Equipment\Exceptions\ModelNotFoundException;
use Borto\Domain\Equipment\Repositories\ModelRepository;

class ReadModel
{
    private ModelRepository $modelRepository;

    public function __construct(ModelRepository $modelRepository)
    {
        $this->modelRepository = $modelRepository;
    }

    public function handle(int $id): ModelEntity
    {
        $model = $this->modelRepository->getById($id);

        if (!$model) {
            throw new ModelNotFoundException();
        }

        return $model;
    }
}

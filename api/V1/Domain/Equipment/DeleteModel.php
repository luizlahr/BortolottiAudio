<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment;

use Borto\Domain\Equipment\Exceptions\ModelNotFoundException;
use Borto\Domain\Equipment\Repositories\ModelRepository;

class DeleteModel
{
    private ModelRepository $modelRepository;

    public function __construct(ModelRepository $modelRepository)
    {
        $this->modelRepository = $modelRepository;
    }

    public function handle(int $id): void
    {
        $model = $this->modelRepository->getById($id);

        if (!$model) {
            throw new ModelNotFoundException();
        }

        $this->modelRepository->deleteModel($id);
    }
}

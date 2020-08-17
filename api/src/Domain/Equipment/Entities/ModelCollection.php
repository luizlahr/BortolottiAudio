<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

use ArrayObject;
use Borto\Domain\Equipment\Entities\ModelEntity;

class ModelCollection extends ArrayObject
{
    public function add(ModelEntity $model): void
    {
        $this->append($model);
    }

    /** @param array<ModelEntity> $models */
    public function fill(array $models): void
    {
        foreach ($models as $model) {
            $this->append($model);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($model) {
            return $model->toArray();
        }, $this->getArrayCopy());
    }
}

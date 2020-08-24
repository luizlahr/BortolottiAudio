<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Repositories;

use Borto\Domain\Equipment\Entities\ModelCollection;
use Borto\Domain\Equipment\Entities\ModelEntity;

interface ModelRepository
{
    public function getAll(): ModelCollection;
    public function getById(int $id): ?ModelEntity;
    public function getByName(string $email): ?ModelEntity;
    public function createModel(array $modelData): ModelEntity;
    public function updateModel(int $id, array $modelData): ModelEntity;
    public function deleteModel(int $id): void;
}

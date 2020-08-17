<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment;

use Borto\Domain\Equipment\CreateModel;
use Borto\Domain\Equipment\Entities\ModelRequestEntity;
use Borto\Domain\Equipment\Exceptions\DuplicatedModelException;
use Borto\Domain\Equipment\Repositories\ModelRepository;
use Borto\Infrastructure\DB\Repositories\EloquentModelRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class CreateModelTest extends BaseTestCase
{
    /** @var ModelRepository|MockObject $modelRepository */
    private $modelRepository;

    public function setup(): void
    {
        parent::setup();

        $this->modelRepository = $this->createMock(EloquentModelRepository::class);
    }

    public function testItCanCreateAModel()
    {
        $model = $this->makeModels();
        $modelRequest = new ModelRequestEntity([
            "category_id" => $this->randomId(),
            "brand_id"    => $this->randomId(),
            "name"        => $model->getName(),
        ]);

        $this->modelRepository->expects($this->once())
            ->method('getByName')
            ->willReturn(null);

        $this->modelRepository->expects($this->once())
            ->method('createModel')
            ->willReturn($model);

        $service = $this->getService();
        $response = $service->handle($modelRequest);

        $this->assertEquals($response, $model);
    }

    public function testItCanNotCreateAModelWithDuplicatedName()
    {
        $categoryId = $this->randomId();
        $brandId = $this->randomId();

        $model = $this->makeModels(1, false, [
            "category_id" => $categoryId,
            "brand_id"    => $brandId
        ]);

        $existingModel = $this->makeModels(1, false, [
            "category_id" => $categoryId,
            "brand_id"    => $brandId
        ]);

        $modelRequest = new ModelRequestEntity([
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $model->getName(),
        ]);

        $this->modelRepository->expects($this->once())
            ->method('getByName')
            ->willReturn($existingModel);

        $service = $this->getService();

        $this->expectException(DuplicatedModelException::class);
        $service->handle($modelRequest);
    }

    public function getService(): CreateModel
    {
        return new CreateModel($this->modelRepository);
    }
}

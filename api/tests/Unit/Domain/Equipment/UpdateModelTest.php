<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment;

use Borto\Domain\Equipment\Entities\ModelRequestEntity;
use Borto\Domain\Equipment\Exceptions\DuplicatedModelException;
use Borto\Domain\Equipment\Exceptions\ModelNotFoundException;
use Borto\Domain\Equipment\Repositories\ModelRepository;
use Borto\Domain\Equipment\UpdateModel;
use Borto\Infrastructure\DB\Repositories\EloquentModelRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class UpdateModelTest extends BaseTestCase
{
    /** @var ModelRepository|MockObject $userRepository */
    private $modelRepository;

    public function setup(): void
    {
        parent::setup();

        $this->modelRepository = $this->createMock(EloquentModelRepository::class);
    }

    public function testItCanUpdateAModel()
    {
        $model = $this->makeModels();
        $modelRequest = new ModelRequestEntity([
            "category_id" => $this->randomId(),
            "brand_id"    => $this->randomId(),
            "name"        => $model->getName()
        ]);

        $this->modelRepository->expects($this->once())
            ->method('getById')
            ->willReturn($model);

        $this->modelRepository->expects($this->once())
            ->method('getByName')
            ->willReturn(null);

        $this->modelRepository->expects($this->once())
            ->method('updateModel')
            ->willReturn($model);

        $service = $this->getService();
        $response = $service->handle($model->getId(), $modelRequest);

        $this->assertEquals($response, $model);
    }

    public function testItCanNotUpdateAModelWithDuplicatedName()
    {
        $name = $this->faker->word;
        $category = $this->randomId();
        $brand = $this->randomId();
        $model = $this->makeModels();
        $existingModel = $this->makeModels(1, false, [
            "category_id" => $category,
            "brand_id"    => $brand,
            "name"        => $name
        ]);

        $modelRequest = new ModelRequestEntity([
            "category_id" => $category,
            "brand_id"    => $brand,
            "name"        => $name,
        ]);

        $this->modelRepository->expects($this->once())
            ->method('getById')
            ->willReturn($model);

        $this->modelRepository->expects($this->once())
            ->method('getByName')
            ->willReturn($existingModel);

        $service = $this->getService();

        $this->expectException(DuplicatedModelException::class);
        $service->handle($model->getId(), $modelRequest);
    }

    public function testItCanNotUpdateAnUnexistingModel()
    {
        $wrongId = $this->randomId();
        $modelRequest = new ModelRequestEntity([
            "category_id" => $this->randomId(),
            "brand_id"    => $this->randomId(),
            "name"        => $this->faker->name
        ]);

        $this->modelRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $service = $this->getService();

        $this->expectException(ModelNotFoundException::class);
        $service->handle($wrongId, $modelRequest);
    }

    public function getService(): UpdateModel
    {
        return new UpdateModel($this->modelRepository);
    }
}

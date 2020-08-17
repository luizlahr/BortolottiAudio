<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment;

use Borto\Domain\Equipment\Exceptions\ModelNotFoundException;
use Borto\Domain\Equipment\ReadModel;
use Borto\Domain\Equipment\Repositories\ModelRepository;
use Borto\Infrastructure\DB\Repositories\EloquentModelRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class ReadModelTest extends BaseTestCase
{
    /** @var ModelRepository|MockObject $modelRepository */
    private $modelRepository;

    public function setup(): void
    {
        parent::setup();

        $this->modelRepository = $this->createMock(EloquentModelRepository::class);
    }

    public function testItCanReadAModel()
    {
        $model = $this->makeModels();

        $this->modelRepository->expects($this->once())
            ->method('getById')
            ->willReturn($model);

        $service = $this->getService();
        $response = $service->handle($this->randomId());

        $this->assertEquals($response, $model);
    }

    public function testItCanNotReadAnUnexistingUser()
    {
        $this->modelRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $this->expectException(ModelNotFoundException::class);

        $service = $this->getService();
        $service->handle($this->randomId());
    }

    public function getService(): ReadModel
    {
        return new ReadModel($this->modelRepository);
    }
}

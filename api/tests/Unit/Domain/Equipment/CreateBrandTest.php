<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment;

use Borto\Domain\Equipment\CreateBrand;
use Borto\Domain\Equipment\Entities\BrandRequestEntity;
use Borto\Domain\Equipment\Exceptions\DuplicatedBrandException;
use Borto\Domain\Equipment\Repository\BrandRepository;
use Borto\Infrastructure\DB\Repositories\EloquentBrandRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class CreateBrandTest extends BaseTestCase
{
    /** @var BrandRepository|MockObject $brandRepository */
    private $brandRepository;

    public function setup(): void
    {
        parent::setup();

        $this->brandRepository = $this->createMock(EloquentBrandRepository::class);
    }

    public function testItCanCreateABrand()
    {
        $brand = $this->makeBrands();
        $brandRequest = new BrandRequestEntity([
            "id"   => $this->randomId(),
            "name" => $this->faker->name
        ]);

        $this->brandRepository->expects($this->once())
            ->method('getByName')
            ->willReturn(null);

        $this->brandRepository->expects($this->once())
            ->method('createBrand')
            ->willReturn($brand);

        $service = $this->getService();
        $response = $service->handle($brandRequest);

        $this->assertEquals($response, $brand);
    }

    public function testItCanNotCreateADuplicatedBrand()
    {
        $brand = $this->makeBrands();
        $brandRequest = new BrandRequestEntity([
            "id"   => $this->randomId(),
            "name" => $this->faker->name
        ]);

        $this->brandRepository->expects($this->once())
            ->method('getByName')
            ->willReturn($brand);

        $service = $this->getService();
        $this->expectException(DuplicatedBrandException::class);
        $response = $service->handle($brandRequest);

        $this->assertEquals($response, $brand);
    }

    public function getService(): CreateBrand
    {
        return new CreateBrand($this->brandRepository);
    }
}

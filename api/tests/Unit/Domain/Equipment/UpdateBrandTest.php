<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Borto\Domain\Equipment\Entities\BrandRequestEntity;
use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\Exceptions\DuplicatedBrandException;
use Borto\Domain\Equipment\Repository\BrandRepository;
use Borto\Domain\Equipment\UpdateBrand;
use Borto\Infrastructure\DB\Repositories\EloquentBrandRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class UpdateBrandTest extends BaseTestCase
{
    /** @var BrandRepository|MockObject $userRepository */
    private $brandRepository;

    public function setup(): void
    {
        parent::setup();

        $this->brandRepository = $this->createMock(EloquentBrandRepository::class);
    }

    public function testItCanUpdateABrand()
    {
        $brand = $this->makeBrands();
        $brandRequest = new BrandRequestEntity([
            "name" => $brand->getName()
        ]);

        $this->brandRepository->expects($this->once())
            ->method('getById')
            ->willReturn($brand);

        $this->brandRepository->expects($this->once())
            ->method('getByName')
            ->willReturn(null);

        $this->brandRepository->expects($this->once())
            ->method('updateBrand')
            ->willReturn($brand);

        $service = $this->getService();
        $response = $service->handle($brand->getId(), $brandRequest);

        $this->assertEquals($response, $brand);
    }

    public function testItCanNotUpdateABrandWithDuplicatedName()
    {
        $name = $this->faker->word;
        $brand = $this->makeBrands();
        $existingBrand = $this->makeBrands(1, false, ["name" => $name]);

        $brandRequest = new BrandRequestEntity([
            "name" => $name,
        ]);

        $this->brandRepository->expects($this->once())
            ->method('getById')
            ->willReturn($brand);

        $this->brandRepository->expects($this->once())
            ->method('getByName')
            ->willReturn($existingBrand);

        $service = $this->getService();

        $this->expectException(DuplicatedBrandException::class);
        $service->handle($brand->getId(), $brandRequest);
    }

    public function testItCanNotUpdateAnUnexistingBrand()
    {
        $wrongId = $this->randomId();
        $brandRequest = new BrandRequestEntity([
            "name" => $this->faker->name
        ]);

        $this->brandRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $service = $this->getService();

        $this->expectException(BrandNotFoundException::class);
        $service->handle($wrongId, $brandRequest);
    }

    public function getService(): UpdateBrand
    {
        return new UpdateBrand($this->brandRepository);
    }
}

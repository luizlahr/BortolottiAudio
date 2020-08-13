<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Authentication;

use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\ReadBrand;
use Borto\Domain\Equipment\Repository\BrandRepository;
use Borto\Infrastructure\DB\Repositories\EloquentBrandRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\BaseTestCase;

class ReadBrandTest extends BaseTestCase
{
    /** @var BrandRepository|MockObject $brandRepository */
    private $brandRepository;

    public function setup(): void
    {
        parent::setup();

        $this->brandRepository = $this->createMock(EloquentBrandRepository::class);
    }

    public function testItCanReadABrand()
    {
        $brand = $this->makeBrands();

        $this->brandRepository->expects($this->once())
            ->method('getById')
            ->willReturn($brand);

        $service = $this->getService();
        $response = $service->handle($this->randomId());
        $this->assertEquals($response, $brand);
    }

    public function testItCanNotReadAnUnexistingUser()
    {
        $this->brandRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $service = $this->getService();

        $this->expectException(BrandNotFoundException::class);
        $service->handle($this->randomId());
    }

    public function getService(): ReadBrand
    {
        return new ReadBrand($this->brandRepository);
    }
}

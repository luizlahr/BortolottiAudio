<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\BrandCollection;
use Borto\Domain\Equipment\Entities\BrandEntity;
use Tests\BaseTestCase;

class BrandCollectionTest extends BaseTestCase
{
    public function testItCanAddToCollection()
    {
        $brand = $this->makeBrands();
        $collection = new BrandCollection();
        $collection->add($brand);

        $this->assertCount(1, $collection);
    }

    public function testItCanFillCategoryCollection(): void
    {
        $amount = $this->faker->numberBetween(2, 10);
        $entities = $this->makeCategories($amount, true);

        $collection = new BrandCollection();

        $collection->fill($entities);
        $this->assertCount($amount, $collection);
    }

    public function testItCanConvertBrandCollectionToArray(): void
    {
        $id = $this->randomId();
        $name = $this->faker->name;

        $entity = new BrandEntity(
            $id,
            $name,
        );

        $collection = new BrandCollection();
        $collection->add($entity);

        $this->assertEquals($collection->toArray(), [[
            "id"   => $id,
            "name" => $name,
        ]]);
    }
}

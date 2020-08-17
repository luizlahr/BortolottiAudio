<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\ModelCollection;
use Borto\Domain\Equipment\Entities\ModelEntity;
use Tests\BaseTestCase;

class ModelCollectionTest extends BaseTestCase
{
    public function testItCanAddToCollection()
    {
        $brand = $this->makeModels();
        $collection = new ModelCollection();
        $collection->add($brand);

        $this->assertCount(1, $collection);
    }

    public function testItCanFillCategoryCollection(): void
    {
        $amount = $this->faker->numberBetween(2, 10);
        $entities = $this->makeCategories($amount, true);

        $collection = new ModelCollection();

        $collection->fill($entities);
        $this->assertCount($amount, $collection);
    }

    public function testItCanConvertCollectionToArray(): void
    {
        $id = $this->randomId();
        $categoryId = $this->randomId();
        $brandId = $this->randomId();
        $name = $this->faker->name;

        $entity = new ModelEntity(
            $id,
            $categoryId,
            $brandId,
            $name,
        );

        $collection = new ModelCollection();
        $collection->add($entity);

        $this->assertEquals($collection->toArray(), [[
            "id"          => $id,
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
        ]]);
    }
}

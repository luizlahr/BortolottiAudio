<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\CategoryCollection;
use Borto\Domain\Equipment\Entities\CategoryEntity;
use Tests\BaseTestCase;

class CategoryCollectionTest extends BaseTestCase
{
    public function testItCanAddToCategoryCollection(): void
    {
        $entity = $this->makeCategories();

        $collection = new CategoryCollection();

        $collection->add($entity);
        $this->assertCount(1, $collection);
    }

    public function testItCanFillCategoryCollection(): void
    {
        $amount = $this->faker->numberBetween(2, 10);
        $entities = $this->makeCategories($amount, true);

        $collection = new CategoryCollection();

        $collection->fill($entities);
        $this->assertCount($amount, $collection);
    }

    public function testItCanConvertCategoryCollectionToArray(): void
    {
        $id = $this->randomId();
        $name = $this->faker->name;

        $entity = new CategoryEntity(
            $id,
            $name,
        );

        $collection = new CategoryCollection();
        $collection->add($entity);

        $this->assertEquals($collection->toArray(), [[
            "id"   => $id,
            "name" => $name,
        ]]);
    }
}

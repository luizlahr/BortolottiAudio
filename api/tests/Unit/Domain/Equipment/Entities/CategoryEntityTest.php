<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\CategoryEntity;
use Tests\BaseTestCase;

class CategoryEntityTest extends BaseTestCase
{
    public function testItCanCreateCategoryEntity()
    {
        $id = $this->randomId();
        $name = $this->faker->name;

        $entity = new CategoryEntity(
            $id,
            $name
        );

        $this->assertEquals($entity->getId(), $id);
        $this->assertEquals($entity->getName(), $name);
    }

    public function testItCanConvertCategoryEntityToArray()
    {
        $id = $this->randomId();
        $name = $this->faker->name;

        $entity = new CategoryEntity(
            $id,
            $name
        );

        $this->assertEquals($entity->toArray(), [
            "id"   => $id,
            "name" => $name
        ]);
    }
}

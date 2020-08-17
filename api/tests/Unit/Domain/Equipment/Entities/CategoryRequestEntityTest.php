<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\CategoryRequestEntity;
use Tests\BaseTestCase;

class CategoryRequestEntityTest extends BaseTestCase
{
    public function testItCanCreateCategoryRequestEntity()
    {
        $id = $this->randomId();
        $name = $this->faker->name;

        $entity = new CategoryRequestEntity([
            "name" => $name
        ]);

        $this->assertEquals($entity->getName(), $name);
    }

    public function testItCanConvertCategoryRequestEntityToArray()
    {
        $name = $this->faker->name;

        $entity = new CategoryRequestEntity([
            "name" => $name
        ]);


        $this->assertEquals($entity->toArray(), [
            "name" => $name
        ]);
    }
}

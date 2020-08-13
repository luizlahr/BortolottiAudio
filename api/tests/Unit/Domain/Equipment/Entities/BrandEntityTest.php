<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\BrandEntity;
use Tests\BaseTestCase;

class BrandEntityTest extends BaseTestCase
{
    public function testItCanCreateABrandEntity()
    {
        $id = $this->randomId();
        $name = $this->faker->name;

        $entity = new BrandEntity($id, $name);

        $this->assertEquals($entity->getId(), $id);
        $this->assertEquals($entity->getName(), $name);
    }

    public function testItCanBeConvertedToArray()
    {
        $id = $this->randomId();
        $name = $this->faker->name;

        $entity = new BrandEntity($id, $name);

        $this->assertEquals($entity->toArray(), [
            "id"   => $id,
            "name" => $name
        ]);
    }
}

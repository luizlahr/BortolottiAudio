<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\BrandRequestEntity;
use Tests\BaseTestCase;

class BrandRequestEntityTest extends BaseTestCase
{
    public function testItCanCreateBrandRequestEntity()
    {
        $name = $this->faker->name;

        $entity = new BrandRequestEntity([
            "name" => $name
        ]);

        $this->assertEquals($entity->getName(), $name);
    }

    public function testItCanConvertBrandRequestEntityToArray()
    {
        $name = $this->faker->name;

        $entity = new BrandRequestEntity([
            "name" => $name
        ]);


        $this->assertEquals($entity->toArray(), [
            "name" => $name
        ]);
    }
}

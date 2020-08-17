<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\ModelEntity;
use Tests\BaseTestCase;

class ModelEntityTest extends BaseTestCase
{
    public function testItCanCreateAnEntity()
    {
        $id = $this->randomId();
        $categoryId = $this->randomId();
        $brandId = $this->randomId();
        $name = $this->randomWord(2);

        $entity = new ModelEntity(
            $id,
            $categoryId,
            $brandId,
            $name
        );

        $this->assertEquals($entity->getId(), $id);
        $this->assertEquals($entity->getCategoryId(), $categoryId);
        $this->assertEquals($entity->getBrandId(), $brandId);
        $this->assertEquals($entity->getName(), $name);
    }

    public function testItCanConvertToArray()
    {
        $id = $this->randomId();
        $categoryId = $this->randomId();
        $brandId = $this->randomId();
        $name = $this->randomWord(2);

        $entity = new ModelEntity(
            $id,
            $categoryId,
            $brandId,
            $name
        );

        $this->assertEquals($entity->toArray(), [
            "id"          => $id,
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name
        ]);
    }
}

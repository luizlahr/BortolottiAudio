<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\ModelRequestEntity;
use Tests\BaseTestCase;

class ModelRequestEntityTest extends BaseTestCase
{
    public function testItCanCreateAnEntity()
    {
        $categoryId = $this->randomId();
        $brandId = $this->randomId();
        $name = $this->randomWord(2);

        $entity = new ModelRequestEntity([
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name
        ]);

        $this->assertEquals($entity->getCategoryId(), $categoryId);
        $this->assertEquals($entity->getBrandId(), $brandId);
        $this->assertEquals($entity->getName(), $name);
    }

    public function testItCanConvertToArray()
    {
        $categoryId = $this->randomId();
        $brandId = $this->randomId();
        $name = $this->randomWord(2);

        $entity = new ModelRequestEntity([
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name
        ]);

        $this->assertEquals($entity->toArray(), [
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name
        ]);
    }
}

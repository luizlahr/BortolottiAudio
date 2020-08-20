<?php

declare(strict_types = 1);

namespace Tests\Unit\Domain\Equipment\Entities;

use Borto\Domain\Equipment\Entities\ModelEntity;
use Tests\BaseTestCase;

class ModelEntityTest extends BaseTestCase
{
    public function testItCanCreateAModelEntity()
    {
        $id = $this->randomId();
        $categoryId = $this->randomId();
        $brandId = $this->randomId();
        $name = $this->randomWord(2);
        $category = $this->makeCategories();
        $brand = $this->makeBrands();

        $entity = new ModelEntity(
            $id,
            $categoryId,
            $brandId,
            $name,
            $category,
            $brand
        );

        $this->assertEquals($entity->getId(), $id);
        $this->assertEquals($entity->getCategoryId(), $categoryId);
        $this->assertEquals($entity->getBrandId(), $brandId);
        $this->assertEquals($entity->getName(), $name);
        $this->assertEquals($entity->getCategory(), $category);
        $this->assertEquals($entity->getBrand(), $brand);
    }

    public function testItCanConvertModelToArray()
    {
        $id = $this->randomId();
        $categoryId = $this->randomId();
        $brandId = $this->randomId();
        $name = $this->randomWord(2);
        $category = $this->makeCategories();
        $brand = $this->makeBrands();

        $entity = new ModelEntity(
            $id,
            $categoryId,
            $brandId,
            $name,
            $category,
            $brand
        );

        $this->assertEquals($entity->toArray(), [
            "id"          => $id,
            "category_id" => $categoryId,
            "brand_id"    => $brandId,
            "name"        => $name,
            "category"    => $category->toArray(),
            "brand"       => $brand->toArray()
        ]);
    }
}

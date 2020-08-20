<?php

declare(strict_types = 1);

namespace Tests\Integration\DB\Models;

use Borto\Infrastructure\DB\Models\Brand;
use Borto\Infrastructure\DB\Models\Category;
use Borto\Infrastructure\DB\Models\Model;
use Tests\TestCase;

class ModelTest extends TestCase
{
    public function testItHasACategory(): void
    {
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();
        $model = factory(Model::class)->create([
            "category_id" => $category->id,
            "brand_id"    => $brand->id
        ]);

        $this->assertInstanceOf(Category::class, $model->category);
        $this->assertEquals($model->category->id, $category->id);
    }

    public function testItHasABrand(): void
    {
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();
        $model = factory(Model::class)->create([
            "category_id" => $category->id,
            "brand_id"    => $brand->id
        ]);

        $this->assertInstanceOf(Brand::class, $model->brand);
        $this->assertEquals($model->brand->id, $brand->id);
    }
}

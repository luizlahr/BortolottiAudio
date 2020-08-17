<?php

declare(strict_types = 1);

namespace Tests\Integration\Db\Models;

use Borto\Infrastructure\DB\Models\Brand;
use Borto\Infrastructure\DB\Models\Category;
use Borto\Infrastructure\DB\Models\Model;
use Tests\TestCase;

class BrandTest extends TestCase
{
    public function testItHasModels(): void
    {
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();
        factory(Model::class)->create([
            "category_id" => $category->id,
            "brand_id"    => $brand->id
        ]);

        $this->assertCount(1, $brand->models);

        foreach ($brand->models as $model) {
            $this->assertInstanceOf(Model::class, $model);
        }
    }
}

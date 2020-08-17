<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Borto\Infrastructure\DB\Models\Brand;
use Borto\Infrastructure\DB\Models\Category;
use Borto\Infrastructure\DB\Models\Model;
use Borto\Infrastructure\DB\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class ModelTest extends TestCase
{
    private array $authHeader;

    public function setup(): void
    {
        parent::setup();
        $authUser = factory(User::class)->create();
        $this->authHeader = $this->setAuthHeader($authUser);
    }

    /** @group ModelController */
    public function testItCanListAllModels()
    {
        $models = factory(Model::class)->create();
        $response = $this->get('/equipments/models', $this->authHeader);
        $response->assertOk();
    }

    /** @group ModelController */
    public function testItCanCreateAModel()
    {
        $this->withoutExceptionHandling();
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();

        $requestData = [
            "category_id" => $category->id,
            "brand_id"    => $brand->id,
            "name"        => $this->randomWord(5)
        ];

        $response = $this->post('/equipments/models', $requestData, $this->authHeader);
        $response->assertCreated();
        $this->assertDatabaseHas('models', $requestData);
    }

    /** @group ModelController */
    public function testItCanCreateAModelWithSameNameDifferentCategory()
    {
        $name = $this->randomWord(5);

        $category = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();

        factory(Model::class)->create([
            "category_id" => $category->id,
            "brand_id"    => $brand->id,
            "name"        => $name
        ]);

        $requestData = [
            "category_id" => $category2->id,
            "brand_id"    => $brand->id,
            "name"        => $name
        ];

        $response = $this->post('/equipments/models', $requestData, $this->authHeader);
        $response->assertCreated();
        $this->assertDatabaseHas('models', $requestData);
    }

    /** @group ModelController */
    public function testItCanCreateAModelWithSameNameDifferentBrand()
    {
        $name = $this->randomWord(5);

        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();
        $brand2 = factory(Brand::class)->create();

        factory(Model::class)->create([
            "category_id" => $category->id,
            "brand_id"    => $brand->id,
            "name"        => $name
        ]);

        $requestData = [
            "category_id" => $category->id,
            "brand_id"    => $brand2->id,
            "name"        => $name
        ];

        $response = $this->post('/equipments/models', $requestData, $this->authHeader);
        $response->assertCreated();
        $this->assertDatabaseHas('models', $requestData);
    }

    /** @group ModelController */
    public function testItCanNotCreateADuplicatedModel()
    {
        $name = $this->randomWord(5);

        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();

        factory(Model::class)->create([
            "category_id" => $category->id,
            "brand_id"    => $brand->id,
            "name"        => $name
        ]);

        $requestData = [
            "category_id" => $category->id,
            "brand_id"    => $brand->id,
            "name"        => $name
        ];

        $response = $this->post('/equipments/models', $requestData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "name" => "este modelo já existe."
        ]);
    }

    /** @group ModelController */
    public function testItCanUpdateModelName()
    {
        $model = factory(Model::class)->create();
        $name = $this->randomWord(5);

        $requestData = [
            "category_id" => $model->category->id,
            "brand_id"    => $model->brand->id,
            "name"        => $name
        ];

        $response = $this->put("/equipments/models/{$model->id}", $requestData, $this->authHeader);
        $response->assertOk();
        $this->assertDatabaseHas('models', [
            "name" => $name
        ]);
    }

    /** @group ModelController */
    public function testItCanNotUpdateModelWithExistingNameCategoryAndBrand()
    {
        $name = $this->randomWord(5);
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();
        $model = factory(Model::class)->create([
            "name"        => $name,
            "category_id" => $category->id,
            "brand_id"    => $brand->id
        ]);

        $model2 = factory(Model::class)->create();

        $requestData = [
            "category_id" => $category->id,
            "brand_id"    => $brand->id,
            "name"        => $name
        ];

        $response = $this->put("/equipments/models/{$model2->id}", $requestData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "name" => "este modelo já existe."
        ]);
    }

    /** @group ModelController */
    public function testItCanNotUpdateUnexistingModel()
    {
        $model = factory(Model::class)->create();
        $name = $this->randomWord(5);
        $wrongId = $model->id + 1;

        $requestData = [
            "category_id" => $model->category->id,
            "brand_id"    => $model->brand->id,
            "name"        => $name
        ];

        $response = $this->put("/equipments/models/{$wrongId}", $requestData, $this->authHeader);
        $response->assertNotFound();
    }

    /** @group ModelController */
    public function testItCanNotUpdateModelWithExistingName()
    {
        $name = $this->randomWord(5);
        $category = factory(Category::class)->create();
        $brand = factory(Brand::class)->create();
        factory(Model::class)->create([
            "name"        => $name,
            "category_id" => $category->id,
            "brand_id"    => $brand->id,
        ]);
        $model = factory(Model::class)->create([
            "category_id" => $category->id,
            "brand_id"    => $brand->id,
        ]);

        $requestData = [
            "category_id" => $model->category->id,
            "brand_id"    => $model->brand->id,
            "name"        => $name
        ];

        $response = $this->put("/equipments/models/{$model->id}", $requestData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @group ModelController */
    public function testItCanShowAModel()
    {
        $model = factory(Model::class)->create();

        $response = $this->get("/equipments/models/{$model->id}", $this->authHeader);
        $response->assertOk();
        $response->assertJsonFragment([
            "name" => $model->name
        ]);
    }

    /** @group ModelController */
    public function testItCanShowUnexistingModel()
    {
        $model = factory(Model::class)->create();
        $wrongId = $model->id + 1;

        $response = $this->get("/equipments/models/{$wrongId}", $this->authHeader);
        $response->assertNotFound();
        $response->assertJsonFragment([
            "message" => "Modelo não encontrado."
        ]);
    }

    /** @group ModelController */
    public function testItCanDeleteAModel()
    {
        $model = factory(Model::class)->create();

        $response = $this->delete("/equipments/models/{$model->id}", [], $this->authHeader);
        $response->assertNoContent();
    }

    /** @group ModelController */
    public function testItCantDeleteUnexistingModel()
    {
        $model = factory(Model::class)->create();
        $wrongId = $model->id + 1;

        $response = $this->delete("/equipments/models/{$wrongId}", [], $this->authHeader);
        $response->assertNotFound();
        $response->assertJsonFragment([
            "message" => "Modelo não encontrado."
        ]);
    }
}

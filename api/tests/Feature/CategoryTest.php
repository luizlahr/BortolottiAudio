<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Infrastructure\DB\Models\Category;
use Borto\Infrastructure\DB\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    private array $authHeader;

    public function setup(): void
    {
        parent::setup();
        $user = factory(User::class)->create();
        $this->authHeader = $this->setAuthHeader($user);
    }

    public function testItCanListAllCategories()
    {
        $amount = $this->faker->numberBetween(1, 10);
        $categories = factory(Category::class, $amount)->create();

        $response = $this->get('/equipments/categories', $this->authHeader);
        foreach ($categories as $category) {
            $entity = new CategoryEntity(
                $category->id,
                $category->name,
            );
            $response->assertJsonFragment($entity->toArray());
        }
    }

    public function testItCanCreateACategory()
    {
        $categoryData = [
            "name" => $this->randomWord(5),
        ];

        $response = $this->post('/equipments/categories', $categoryData, $this->authHeader);
        $response->assertCreated();
        $response->assertJsonFragment([
            "name" => $categoryData["name"],
        ]);
    }

    public function testItValidateRequiredFieldsWhenCreatingCategory()
    {
        $categoryData = [];

        $response = $this->post('/equipments/categories', $categoryData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [
                ["name" => "O campo nome é obrigatório."],
            ]
        ]);
    }

    public function testItValidatesNameMinLenghtWhenCreatingCategory()
    {
        $shortWord = $this->randomWord(2);

        $categoryData = [
            "name" => $shortWord,
        ];

        $response = $this->post('/equipments/categories', $categoryData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [
                ["name" => "mínimo 3 caracteres."],
            ]
        ]);
    }

    public function testItCanUpdateOnlyCategoryNameHere()
    {
        $category = factory(Category::class)->create();

        $categoryData = [
            "name" => $this->randomPassword(5),
        ];

        $response = $this->patch("/equipments/categories/{$category->id}", $categoryData, $this->authHeader);
        $response->assertOk();
        $response->assertJsonFragment([
            "name" => $categoryData["name"],
        ]);

        $this->assertDatabaseHas('categories', [
            "id"   => $category->id,
            "name" => $categoryData["name"],
        ]);
    }

    public function testItCanNotUpdateCategoryNameIfItIsInUse()
    {
        $name = $this->faker->word;
        factory(Category::class)->create([
            "name" => $name
        ]);

        $updateCategory = factory(Category::class)->create();

        $categoryData = [
            "name" => $name
        ];

        $response = $this->patch("/equipments/categories/{$updateCategory->id}", $categoryData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('categories', [
            "id"   => $updateCategory->id,
            "name" => $updateCategory->name,
            ]);
    }

    public function testItValidatesNameMinLenghtWhenUpdatingCategory()
    {
        $shortWord = $this->randomWord(2);

        $categoryData = [
            "name" => $shortWord,
        ];

        $response = $this->put("/equipments/categories/{$shortWord}", $categoryData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [
                ["name" => "mínimo 3 caracteres."],
            ]
        ]);
    }

    public function testItCanDeleteACategory()
    {
        $categoory = factory(Category::class)->create();

        $response = $this->delete("/equipments/categories/{$categoory->id}", [], $this->authHeader);
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('categories', [
            "id" => $categoory->id
        ]);
    }

    public function testItCantDeleteUnexistingCategory()
    {
        $category = factory(Category::class)->create();
        $wrongId = $category->id + 1;

        $response = $this->delete("/equipments/categories/{$wrongId}", [], $this->authHeader);
        $response->assertNotFound();
        $response->assertJsonFragment([
            "message" => "Categoria não encontrada."
        ]);
    }

    public function testItCanReadACategory()
    {
        $category = factory(Category::class)->create();
        $entity = new CategoryEntity($category->id, $category->name);

        $response = $this->get("/equipments/categories/{$category->id}", $this->authHeader);
        $response->assertJsonFragment($entity->toArray());
    }

    public function testItCanNotReadAnUnexistingCategory()
    {
        $category = factory(Category::class)->create();
        $wrongID = $category->id + 1;

        $response = $this->get("/equipments/categories/{$wrongID}", $this->authHeader);
        $response->assertNotFound();
        $response->assertJsonFragment(["message" => "Categoria não encontrada."]);
    }
}

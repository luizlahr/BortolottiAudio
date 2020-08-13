<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Infrastructure\DB\Models\Brand;
use Borto\Infrastructure\DB\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class BrandTest extends TestCase
{
    private array $authHeader;

    public function setup(): void
    {
        parent::setup();
        $user = factory(User::class)->create();
        $this->authHeader = $this->setAuthHeader($user);
    }

    public function testItCanListAllBrands()
    {
        $amount = $this->faker->numberBetween(1, 10);
        $brands = factory(Brand::class, $amount)->create();

        $response = $this->get('/equipments/brands', $this->authHeader);
        foreach ($brands as $brand) {
            $entity = new BrandEntity(
                $brand->id,
                $brand->name,
            );
            $response->assertJsonFragment($entity->toArray());
        }
    }

    public function testItCanCreateABrand()
    {
        $brandData = [
            "name" => $this->randomWord(5),
        ];

        $response = $this->post('/equipments/brands', $brandData, $this->authHeader);
        $response->assertCreated();
        $response->assertJsonFragment([
            "name" => $brandData["name"],
        ]);
    }

    public function testItValidateRequiredFieldsWhenCreatingBrand()
    {
        $brandData = [];

        $response = $this->post('/equipments/brands', $brandData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [
                ["name" => "O campo nome é obrigatório."],
            ]
        ]);
    }

    public function testItValidatesNameMinLenghtWhenCreatingBrand()
    {
        $shortWord = $this->randomPassword(2);

        $brandData = [
            "name" => $shortWord,
        ];

        $response = $this->post('/equipments/brands', $brandData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [
                ["name" => "mínimo 3 caracteres."],
            ]
        ]);
    }

    public function testItCanUpdateOnlyBrandNameHere()
    {
        $brand = factory(Brand::class)->create();

        $brandData = [
            "name" => $this->randomPassword(5),
        ];

        $response = $this->patch("/equipments/brands/{$brand->id}", $brandData, $this->authHeader);
        $response->assertOk();
        $response->assertJsonFragment([
            "name" => $brandData["name"],
        ]);

        $this->assertDatabaseHas('brands', [
            "id"   => $brand->id,
            "name" => $brandData["name"],
        ]);
    }

    public function testItCanNotUpdateBrandNameIfItIsInUse()
    {
        $name = $this->faker->word;
        factory(Brand::class)->create([
            "name" => $name
        ]);

        $updateBrand = factory(Brand::class)->create();

        $brandData = [
            "name" => $name
        ];

        $response = $this->patch("/equipments/brands/{$updateBrand->id}", $brandData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('brands', [
            "id"   => $updateBrand->id,
            "name" => $updateBrand->name,
            ]);
    }

    public function testItValidatesNameMinLenghtWhenUpdatingBrand()
    {
        $shortWord = $this->randomWord(2);

        $brandData = [
            "name" => $shortWord,
        ];

        $response = $this->put("/equipments/brands/{$shortWord}", $brandData, $this->authHeader);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [
                ["name" => "mínimo 3 caracteres."],
            ]
        ]);
    }

    public function testItCanDeleteABrand()
    {
        $categoory = factory(Brand::class)->create();

        $response = $this->delete("/equipments/brands/{$categoory->id}", [], $this->authHeader);
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('brands', [
            "id" => $categoory->id
        ]);
    }

    public function testItCantDeleteUnexistingBrand()
    {
        $brand = factory(Brand::class)->create();
        $wrongId = $brand->id + 1;

        $response = $this->delete("/equipments/brands/{$wrongId}", [], $this->authHeader);
        $response->assertNotFound();
        $response->assertJsonFragment([
            "message" => "Marca não encontrada."
        ]);
    }

    public function testItCanReadABrand()
    {
        $brand = factory(Brand::class)->create();
        $entity = new BrandEntity($brand->id, $brand->name);

        $response = $this->get("/equipments/brands/{$brand->id}", $this->authHeader);
        $response->assertJsonFragment($entity->toArray());
    }

    public function testItCanNotReadAnUnexistingBrand()
    {
        $brand = factory(Brand::class)->create();
        $wrongID = $brand->id + 1;

        $response = $this->get("/equipments/brands/{$wrongID}", $this->authHeader);
        $response->assertNotFound();
        $response->assertJsonFragment(["message" => "Marca não encontrada."]);
    }
}

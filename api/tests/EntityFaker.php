<?php

declare(strict_types = 1);

namespace Tests;

use Borto\Domain\Authentication\Entities\UserCollection;
use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Domain\Equipment\Entities\CategoryCollection;
use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Equipment\Entities\ModelCollection;
use Borto\Domain\Equipment\Entities\ModelEntity;
use Borto\Domain\Equipment\Entities\PersonCollection;
use Borto\Domain\Person\Entities\AddressEntity;
use Borto\Domain\Person\Entities\PersonEntity;

trait EntityFaker
{
    /** @return UserEntity|array<UserEntity>|UserCollection */
    public function makeUsers(int $amount = 1, bool $toArray = false, array $data = [])
    {
        $users = [];

        for ($current = 1; $current <= $amount; $current++) {
            array_push($users, new UserEntity(
                $data["id"] ?? $this->randomId(),
                $data["name"] ?? $this->faker->name,
                $data["email"] ?? $this->faker->email,
                $data["password"] ?? $this->faker->sha256,
                $data["active"] ?? $this->faker->boolean
            ));
        }

        if (count($users) === 1) {
            return $users[0];
        }

        if ($toArray) {
            return $users;
        }

        $collection = new UserCollection();
        $collection->fill($users);

        return $collection;
    }

    /** @return CategoryEntity|array<CategoryEntity>|CategoryCollection */
    public function makeCategories(int $amount = 1, bool $toArray = false, array $data = [])
    {
        $categories = [];

        for ($current = 1; $current <= $amount; $current++) {
            array_push($categories, new CategoryEntity(
                $data["id"] ?? $this->randomId(),
                $data["name"] ?? $this->faker->name,
            ));
        }

        if (count($categories) === 1) {
            return $categories[0];
        }

        if ($toArray) {
            return $categories;
        }

        $collection = new CategoryCollection();
        $collection->fill($categories);

        return $collection;
    }

    /** @return BrandEntity|array<BrandEntity>|BrandCollection */
    public function makeBrands(int $amount = 1, bool $toArray = false, array $data = [])
    {
        $brands = [];

        for ($current = 1; $current <= $amount; $current++) {
            array_push($brands, new BrandEntity(
                $data["id"] ?? $this->randomId(),
                $data["name"] ?? $this->faker->name,
            ));
        }

        if (count($brands) === 1) {
            return $brands[0];
        }

        if ($toArray) {
            return $brands;
        }

        $collection = new CategoryCollection();
        $collection->fill($brands);

        return $collection;
    }

    /** @return ModelEntity|array<ModelEntity>|ModelCollection */
    public function makeModels(int $amount = 1, bool $toArray = false, array $data = [])
    {
        $models = [];

        $category = $this->makeCategories();
        $brand = $this->makeBrands();

        for ($current = 1; $current <= $amount; $current++) {
            array_push($models, new ModelEntity(
                $data["id"] ?? $this->randomId(),
                $data["category_id"] ?? $this->randomId(),
                $data["brand_id"] ?? $this->randomId(),
                $data["name"] ?? $this->faker->name,
                $data["category"] ?? $category,
                $data["brand"] ?? $brand,
            ));
        }

        if (count($models) === 1) {
            return $models[0];
        }

        if ($toArray) {
            return $models;
        }

        $collection = new ModelCollection();
        $collection->fill($models);

        return $collection;
    }

    /** @return PersonEntity|array<PersonEntity>|PersonCollection */
    public function makePeople(int $amount = 1, bool $toArray = false, array $data = [])
    {
        $people = [];

        $address = new AddressEntity(
            $this->getFieldValue($data, "zipcode", $this->faker->postcode, true),
            $this->getFieldValue($data, "street", $this->faker->streetName, true),
            $this->getFieldValue($data, "streetNumber", $this->faker->buildingNumber, true),
            $this->getFieldValue($data, "neighborhood", $this->faker->city, true),
            $this->getFieldValue($data, "city", $this->faker->city, true),
            $this->getFieldValue($data, "state", $this->fakerBR->stateAbbr, true),
        );

        for ($current = 1; $current <= $amount; $current++) {
            array_push($people, new PersonEntity(
                $this->getFieldValue($data, "id", $this->randomId()),
                $this->getFieldValue($data, "business", $this->faker->boolean),
                $this->getFieldValue($data, "supplier", $this->faker->boolean),
                $this->getFieldValue($data, "name", $this->faker->name),
                $this->getFieldValue($data, "nickname", $this->faker->name, true),
                $this->getFieldValue($data, "email", $this->faker->email, true),
                $this->getFieldValue($data, "mobile", $this->fakerBR->cellphone, true),
                $this->getFieldValue($data, "whatsapp", $this->faker->boolean),
                $this->getFieldValue($data, "phone", $this->fakerBR->landline, true),
                $this->getFieldValue($data, "nid", $this->fakerBR->rg(false), true),
                $this->getFieldValue($data, "ssn", $this->fakerBR->cpf(false), true),
                $address
            ));
        }

        if (count($people) === 1) {
            return $people[0];
        }

        if ($toArray) {
            return $people;
        }

        $collection = new ModelCollection();
        $collection->fill($people);

        return $collection;
    }

    /**
     * @param mixed $fake
     * @param mixed $replace
     * @return mixed
     */
    private function getFieldValue($data, $field, $fake, $nullable = false)
    {
        if (!$nullable) {
            return  $data[$field] ?? $fake;
        }

        return isset($data[$field]) ? $$data[$field] : $fake;
    }
}

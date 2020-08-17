<?php

declare(strict_types = 1);

namespace Tests;

use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Domain\Equipment\Entities\ModelEntity;
use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Domain\Equipment\Entities\ModelCollection;
use Borto\Domain\Equipment\Entities\CategoryCollection;
use Borto\Domain\Authentication\Entities\UserCollection;

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

        for ($current = 1; $current <= $amount; $current++) {
            array_push($models, new ModelEntity(
                $data["id"] ?? $this->randomId(),
                $data["category_id"] ?? $this->randomId(),
                $data["brand_id"] ?? $this->randomId(),
                $data["name"] ?? $this->faker->name,
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
}

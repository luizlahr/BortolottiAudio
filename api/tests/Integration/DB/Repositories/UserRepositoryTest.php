<?php

declare(strict_types = 1);

namespace Tests\Integration\DB\Repositories;

use Borto\Domain\Authentication\Entities\UserCollection;
use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Infrastructure\DB\Models\User;
use Borto\Infrastructure\DB\Repositories\EloquentUserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Hashing\BcryptHasher;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testItImplementUserRepository()
    {
        $repository = $this->getRepository();
        $this->assertInstanceOf(UserRepository::class, $repository);
    }

    public function testItCanGetAll()
    {
        $amount = $this->faker->numberBetween(1, 10);
        $users = factory(User::class, $amount)->create();
        $collection = $this->makeUserCollection($users);

        $repository = $this->getRepository();
        $response = $repository->getAll();

        $this->assertInstanceOf(UserCollection::class, $response);
        $this->assertEquals($response->count(), $amount);
    }

    public function testItCanGetById()
    {
        $user = factory(User::class)->create();
        $entity = $this->makeUserEntity($user);

        $repository = $this->getRepository();
        $response = $repository->getById($user->id);
        $this->assertInstanceOf(UserEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetByWrongId()
    {
        $user = factory(User::class)->create();
        $wrongId = $user->id + 1;

        $repository = $this->getRepository();
        $response = $repository->getById($wrongId);
        $this->assertEquals($response, null);
    }

    public function testItCanGetByEmail()
    {
        $user = factory(User::class)->create();
        $entity = $this->makeUserEntity($user);

        $repository = $this->getRepository();
        $response = $repository->getByEmail($user->email);
        $this->assertInstanceOf(UserEntity::class, $response);
        $this->assertEquals($entity, $response);
    }

    public function testItCanNotGetByWrongEmail()
    {
        $user = factory(User::class)->create();
        $wrongEmail = "wrong-" . $user->email;

        $repository = $this->getRepository();
        $response = $repository->getByEmail($wrongEmail);
        $this->assertEquals($response, null);
    }

    public function testItCanCreateAnUser()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $active = $this->faker->boolean;

        $repository = $this->getRepository();
        $repository->createUser([
            "name"     => $name,
            "email"    => $email,
            "password" => $password,
            "active"   => $active,
        ]);

        $this->assertDatabaseHas('users', [
            "name"   => $name,
            "email"  => $email,
            "active" => $active
        ]);
    }

    public function testItCanUpdateAnExistingUser()
    {
        $user = factory(User::class)->create();

        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $active = $this->faker->boolean;

        $repository = $this->getRepository();
        $repository->updateUser($user->id, [
            "name"     => $name,
            "email"    => $email,
            "password" => $password,
            "active"   => $active,
        ]);

        $this->assertDatabaseHas('users', [
            "id"     => $user->id,
            "name"   => $name,
            "email"  => $email,
            "active" => $active
        ]);
    }

    public function testItCanNotUpdateAnUnexistingUser()
    {
        $user = factory(User::class)->create();
        $wrongId = $user->id + 1;

        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = $this->faker->password;
        $active = $this->faker->boolean;

        $repository = $this->getRepository();
        $this->expectException(UserNotFoundException::class);
        $repository->updateUser($wrongId, [
            "name"     => $name,
            "email"    => $email,
            "password" => $password,
            "active"   => $active,
        ]);
    }

    public function testItCanDeleteAnExistingUser()
    {
        $user = factory(User::class)->create();

        $repository = $this->getRepository();
        $repository->deleteUser($user->id);

        $this->assertDatabaseMissing('users', [
            "id" => $user->id,
        ]);
    }

    public function testItCanNotDeleteAnUnexistingUser()
    {
        $user = factory(User::class)->create();
        $wrongId = $user->id + 1;

        $repository = $this->getRepository();
        $this->expectException(UserNotFoundException::class);
        $repository->deleteUser($wrongId);
        $this->assertDatabaseHas('users', [
            "id" => $user->id,
        ]);
    }

    public function testItCanCreateAuthTokensForExistingUsers()
    {
        $user = factory(User::class)->create();

        $repository = $this->getRepository();
        $repository->createAuthToken($user->id);

        $this->assertDatabaseHas('personal_access_tokens', [
            "tokenable_id" => $user->id,
            "name"         => "user-token",
        ]);
    }

    public function testItCanNotCreateAuthTokensForUnexistingUsers()
    {
        $user = factory(User::class)->create();
        $wrongId = $user->id + 1;

        $repository = $this->getRepository();
        $this->expectException(UserNotFoundException::class);
        $repository->createAuthToken($wrongId);

        $this->assertDatabaseMissing('personal_access_tokens', [
            "tokenable_id" => $wrongId,
            "name"         => "user-token",
        ]);

        $this->assertDatabaseMissing('personal_access_tokens', [
            "tokenable_id" => $user->id,
            "name"         => "user-token",
        ]);
    }

    public function testItCanDeleteAuthTokensForExistingUsers()
    {
        $user = factory(User::class)->create();
        $this->authenticateUser($user);

        $this->assertDatabaseHas('personal_access_tokens', [
            "tokenable_id" => $user->id,
            "name"         => "user-token"
        ]);

        $repository = $this->getRepository();
        $repository->deleteAuthTokens($user->id);

        $this->assertDatabaseMissing('personal_access_tokens', [
            "tokenable_id" => $user->id,
            "name"         => "user-token",
        ]);
    }

    public function testItCanNotDeleteAuthTokensForUnexistingUsers()
    {
        $user = factory(User::class)->create();
        $wrongId = $user->id + 1;
        $this->authenticateUser($user);

        $this->assertDatabaseHas('personal_access_tokens', [
            "tokenable_id" => $user->id,
            "name"         => "user-token"
        ]);

        $repository = $this->getRepository();
        $this->expectException(UserNotFoundException::class);
        $repository->deleteAuthTokens($wrongId);

        $this->assertDatabaseHas('personal_access_tokens', [
            "tokenable_id" => $user->id,
            "name"         => "user-token"
        ]);
    }

    private function getRepository(): UserRepository
    {
        $model = new User();
        $hasher = new BcryptHasher();
        return new EloquentUserRepository($hasher, $model);
    }

    private function makeUserEntity(User $user): UserEntity
    {
        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $user->active
        );
    }

    private function makeUserCollection(Collection $users): UserCollection
    {
        $userCollection = new UserCollection();

        array_map(function ($user) use ($userCollection) {
            $userCollection->add($user->toEntity());
        }, $users->all());

        return $userCollection;
    }
}

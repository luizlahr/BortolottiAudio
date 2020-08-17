<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Infrastructure\DB\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @var array<string,string> $header */
    private array $header;

    public function testItCanListAllUsers()
    {
        $amount = $this->faker->numberBetween(1, 10);
        $users = factory(User::class, $amount)->create();
        $header = $this->setAuthHeader($users->first());

        $response = $this->get('/users', $header);
        foreach ($users as $user) {
            $entity = new UserEntity(
                $user->id,
                $user->name,
                $user->email,
                null,
                $user->active
            );
            $response->assertJsonFragment($entity->toArray());
        }
    }

    public function testItCanCreateAnUser()
    {
        $authUser = factory(User::class)->create();
        $header = $this->setAuthHeader($authUser);

        $password = $this->randomPassword(10);

        $userData = [
            "name"                  => $this->faker->name,
            "email"                 => $this->faker->email,
            "password"              => $password,
            "password_confirmation" => $password,
            "active"                => $this->faker->boolean
        ];

        $response = $this->post('/users', $userData, $header);
        $response->assertCreated();
        $response->assertJsonFragment([
            "name"   => $userData["name"],
            "email"  => $userData["email"],
            "active" => $userData["active"]
        ]);

        $createdUser = json_decode($response->getContent());
        $this->assertDatabaseHas('users', [
            "id"     => $createdUser->id,
            "name"   => $userData["name"],
            "email"  => $userData["email"],
            "active" => $userData["active"]
        ]);
    }

    public function testItValidateRequiredFieldsWhenCreatingUser()
    {
        $authUser = factory(User::class)->create();
        $header = $this->setAuthHeader($authUser);

        $userData = [];

        $response = $this->post('/users', $userData, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [
                ["name" => "O campo nome é obrigatório."],
                ["email"    => "O campo email é obrigatório."],
                ["password" => "O campo senha é obrigatório."]
            ]
        ]);
    }

    public function testItValidatesItHasAValidEmail()
    {
        $authUser = factory(User::class)->create();
        $header = $this->setAuthHeader($authUser);

        $password = $this->randomPassword(10);

        $userData = [
            "name"                  => $this->faker->name,
            "email"                 => $this->faker->name,
            "password"              => $password,
            "password_confirmation" => $password,
            "active"                => $this->faker->boolean
        ];

        $response = $this->post('/users', $userData, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [[
                "email" => "O campo email deve ser um endereço de e-mail válido."
            ]]
        ]);
    }

    public function testItValidatesThePasswordIsConfirmed()
    {
        $authUser = factory(User::class)->create();
        $header = $this->setAuthHeader($authUser);

        $password = $this->randomPassword(10);

        $userData = [
            "name"     => $this->faker->name,
            "email"    => $this->faker->email,
            "password" => $password,
            "active"   => $this->faker->boolean
        ];

        $response = $this->post('/users', $userData, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        // dd($response->getContent());
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [[
                "password" => "O campo senha de confirmação não confere."
            ]]
        ]);
    }

    public function testItValidatesNameAndPasswordMinLenght()
    {
        $authUser = factory(User::class)->create();
        $header = $this->setAuthHeader($authUser);

        $shortWord = $this->randomPassword(3);

        $userData = [
            "name"     => $shortWord,
            "email"    => $this->faker->email,
            "password" => $shortWord,
            "active"   => $this->faker->boolean
        ];

        $response = $this->post('/users', $userData, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment([
            "message" => 'Não autorizado!',
            "errors"  => [
                ["name" => "mínimo 4 caracteres."],
                ["password" => "mínimo 4 caracteres."]
            ]
        ]);
    }

    public function testItCanShowOtherUsersData()
    {
        $loggedUser = factory(User::class)->create();
        $header = $this->setAuthHeader($loggedUser);

        $user = factory(User::class)->create();

        $response = $this->get("/users/{$user->id}", $header);
        $response->assertOk();
        $response->assertJsonFragment([
            "id"     => $user->id,
            "name"   => $user->name,
            "email"  => $user->email,
            "active" => $user->active
        ]);
    }

    public function testItCanNotShowUnexistingUsers()
    {
        $loggedUser = factory(User::class)->create();
        $header = $this->setAuthHeader($loggedUser);
        $wrongId = $loggedUser->id + 1;

        $response = $this->get("/users/{$wrongId}", $header);
        $response->assertNotFound();
        $response->assertJsonFragment(["message" => "Usuário não encontrado."]);
    }

    public function testItCanShowUsersOwnData()
    {
        $user = factory(User::class)->create();
        $header = $this->setAuthHeader($user);

        $response = $this->get("/users/{$user->id}", $header);
        $response->assertOk();
        $response->assertJsonFragment([
            "id"     => $user->id,
            "name"   => $user->name,
            "email"  => $user->email,
            "active" => $user->active
        ]);
    }

    public function testItCanUpdateOnlyNameUnique()
    {
        $user = factory(User::class)->create();
        $header = $this->setAuthHeader($user);

        $userData = [
            "name" => $this->faker->name,
        ];

        $response = $this->patch("/users/{$user->id}", $userData, $header);
        $response->assertOk();
        $response->assertJsonFragment([
            "name"   => $userData["name"],
            "email"  => $user->email,
            "active" => $user->active
        ]);

        $this->assertDatabaseHas('users', [
            "id"     => $user->id,
            "name"   => $userData["name"],
            "email"  => $user->email,
            "active" => $user->active
        ]);
    }

    public function testItCanUpdateOnlyEmailWhichDoesNotExist()
    {
        $user = factory(User::class)->create();
        $header = $this->setAuthHeader($user);

        $userData = [
            "email" => $this->faker->email,
        ];

        $response = $this->patch("/users/{$user->id}", $userData, $header);
        $response->assertOk();
        $response->assertJsonFragment([
            "name"   => $user->name,
            "email"  => $userData["email"],
            "active" => $user->active
        ]);

        $this->assertDatabaseHas('users', [
            "id"     => $user->id,
            "name"   => $user->name,
            "email"  => $userData["email"],
            "active" => $user->active
        ]);
    }

    public function testItCanNotUpdateEmailIfItIsInUse()
    {
        $email = $this->faker->email;
        $user = factory(User::class)->create([
            "email" => $email
        ]);
        $header = $this->setAuthHeader($user);

        $updateUser = factory(User::class)->create();

        $userData = [
            "email" => $email
        ];

        $response = $this->patch("/users/{$updateUser->id}", $userData, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', [
            "id"     => $updateUser->id,
            "name"   => $updateUser->name,
            "email"  => $updateUser->email,
            "active" => $updateUser->active
        ]);
    }

    public function testItCanUpdateOnlyActive()
    {
        $user = factory(User::class)->create();
        $header = $this->setAuthHeader($user);

        $userData = [
            "active" => $this->faker->boolean,
        ];

        $response = $this->patch("/users/{$user->id}", $userData, $header);
        $response->assertOk();
        $response->assertJsonFragment([
            "name"   => $user->name,
            "email"  => $user->email,
            "active" => $userData["active"],
        ]);

        $this->assertDatabaseHas('users', [
            "id"     => $user->id,
            "name"   => $user->name,
            "email"  => $user->email,
            "active" => $userData["active"],
        ]);
    }

    public function testItCanDeleteOtherUsers()
    {
        $loggedUser = factory(User::class)->create();
        $header = $this->setAuthHeader($loggedUser);

        $user = factory(User::class)->create();

        $response = $this->delete("/users/{$user->id}", [], $header);
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('users', [
            "id" => $user->id
        ]);
    }

    public function testItCantDeleteUnexistingUser()
    {
        $loggedUser = factory(User::class)->create();
        $header = $this->setAuthHeader($loggedUser);

        $user = factory(User::class)->create();
        $wrongId = $user->id + 1;

        $response = $this->delete("/users/{$wrongId}", [], $header);
        $response->assertNotFound();
    }

    public function testItCanNotDeleteSelf()
    {
        $user = factory(User::class)->create();
        $header = $this->setAuthHeader($user);

        $response = $this->delete("/users/{$user->id}", [], $header);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('users', [
            "id" => $user->id
        ]);
    }
}

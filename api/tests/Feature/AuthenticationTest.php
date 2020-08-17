<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Borto\Domain\Authentication\Entities\UserEntity;
use Borto\Infrastructure\DB\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function testItCanAuthenticateAnUser()
    {
        $email = $this->faker->email;
        $password = $this->faker->password;

        $user = factory(User::class)->create([
            "email"    => $email,
            "password" => Hash::make($password)
        ]);

        $entity = new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            null,
            $user->active
        );

        $response = $this->post('/auth', [
            "email"    => $email,
            "password" => $password,
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            "user",
            "token"
        ]);
        $response->assertJsonFragment([
            "user" => $entity->toArray()
        ]);
    }

    public function testItCanNotAuthenticateAnUserWithWrongEmail()
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $wrongEmail = "wrong-" . $email;

        factory(User::class)->create([
            "email"    => $email,
            "password" => Hash::make($password)
        ]);

        $response = $this->post('/auth', [
            "email"    => $wrongEmail,
            "password" => $password,
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJsonFragment([
            "message" => 'Credenciais inválidas.'
        ]);
    }

    public function testItCanNotAuthenticateAnUserWithWrongPassword()
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $wrongPassword = "wrong-" . $password;

        factory(User::class)->create([
            "email"    => $email,
            "password" => Hash::make($password)
        ]);

        $response = $this->post('/auth', [
            "email"    => $email,
            "password" => $wrongPassword,
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJsonFragment([
            "message" => 'Credenciais inválidas.'
        ]);
    }

    public function testItCanLogout()
    {
        $user = factory(User::class)->create();
        $token = $this->authenticateUser($user);

        $response = $this->delete('/auth', [], [
            "Authorization" => "Bearer {$token}"
        ]);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }


    public function testItCanNotLogoutIfNotLoggedIn()
    {
        $response = $this->delete('/auth');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJsonFragment([
            "message" => 'unauthenticated'
        ]);
    }
}

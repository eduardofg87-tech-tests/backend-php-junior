<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class SignInUserTest extends TestCase
{
    use RefreshDatabase;

    protected $signinRoute;

    public function setUp(): void
    {
        parent::setUp();

        $this->signinRoute = action('AuthController@signin');
    }

    /** @test */
    public function it_should_sign_in_an_user_with_correct_credentials()
    {
        $user = factory(User::class)->create();

        $this->postJson($this->signinRoute, [
            'email'    => $user->email,
            'password' => 'password'
        ])
            ->assertOk()
            ->assertJsonStructure([
                'status', 'message', 'token_jwt', 'expires_in', 'token_message', 'user'
            ]);
    }

    /** @test */
    public function it_should_allow_only_registered_users_to_sign_in()
    {
        factory(User::class)->create();

        $user = factory(User::class)->make();

        $this->postJson($this->signinRoute, [
            'email'    => $user->email,
            'password' => 'password'
        ])
            ->assertUnauthorized();
    }

    /** @test */
    public function it_should_requires_an_email()
    {
        $response = $this->postJson($this->signinRoute, [
            'email'    => '',
            'password' => 'password'
        ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $arrayContent = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('email', $arrayContent);
    }

    /** @test */
    public function it_should_requires_a_valid_email()
    {
        $response = $this->postJson($this->signinRoute, [
            'email'    => 'jhon.doe@.com',
            'password' => 'password'
        ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $arrayContent = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('email', $arrayContent);
    }

    /** @test */
    public function it_should_requires_a_password()
    {
        $response = $this->postJson($this->signinRoute, [
            'email'    => 'jhon.doe@mail.com',
            'password' => ''
        ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $arrayContent = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('password', $arrayContent);
    }
}

<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreUserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $storeRoute;

    public function setUp(): void
    {
        parent::setUp();

        $this->storeRoute = action('UserController@store');
        $this->user       = factory(User::class)->create(['name' => 'John Doe']);
    }

    /** @test */
    public function it_should_store_an_user()
    {
        $maryAnn = factory(User::class)->raw();

        $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('users', [
            'name'  => $maryAnn['name'],
            'email' => $maryAnn['email'],
            'cpf'   => $maryAnn['cpf'],
        ]);
    }

    /** @test */
    public function it_should_require_a_name()
    {
        $maryAnn = factory(User::class)->raw(['name' => '']);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('name', $content);
    }

    /** @test */
    public function it_should_prevent_register_if_a_name_has_more_255_characters()
    {
        $maryAnn = factory(User::class)->raw(['name' => Str::random(256)]);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('name', $content);
    }

    /** @test */
    public function it_should_require_an_email()
    {
        $maryAnn = factory(User::class)->raw(['email' => '']);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('email', $content);
    }

    /** @test */
    public function it_should_require_a_valid_email()
    {
        $maryAnn = factory(User::class)->raw(['email' => 'mary@.com']);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('email', $content);
    }

    /** @test */
    public function it_should_prevent_register_an_email_that_already_exists_in_database()
    {
        $maryAnn = factory(User::class)->raw(['email' => $this->user->email]);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('email', $content);
    }

    /** @test */
    public function it_should_prevent_register_if_an_email_has_more_255_characters()
    {
        $maryAnn = factory(User::class)->raw(['email' => Str::random(256)]);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('email', $content);
    }

    /** @test */
    public function it_should_require_a_cpf()
    {
        $maryAnn = factory(User::class)->raw(['cpf' => '']);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('cpf', $content);
    }

    /** @test */
    public function it_should_require_a_valid_cpf()
    {
        $maryAnn = factory(User::class)->raw(['cpf' => '0519381416']);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('cpf', $content);
    }

    /** @test */
    public function it_should_prevent_register_an_cpf_that_already_exists_in_database()
    {
        $maryAnn = factory(User::class)->raw(['cpf' => $this->user->cpf]);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('cpf', $content);
    }

    /** @test */
    public function it_should_require_a_password()
    {
        $maryAnn = factory(User::class)->raw(['password' => '']);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('password', $content);
    }

    /** @test */
    public function it_should_prevent_register_if_a_password_has_below_than_255_characters()
    {
        $maryAnn = factory(User::class)->raw(['password' => 'hello']);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('password', $content);
    }

    /** @test */
    public function it_should_prevent_register_if_a_password_has_more_than_255_characters()
    {
        $maryAnn = factory(User::class)->raw(['password' => Str::random(256)]);

        $response = $this->actingAs($this->user)
            ->postJson($this->storeRoute, $maryAnn)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('password', $content);
    }

    protected function jsonToArray($content)
    {
        return json_decode($content, true);
    }
}

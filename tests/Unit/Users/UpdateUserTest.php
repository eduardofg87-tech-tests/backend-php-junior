<?php

namespace Tests\Unit\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_be_possible_to_update_a_user()
    {
        $jhonDoe = factory(User::class)->create();
        $newInfo = [
            'name'  => 'Mary Ann',
            'email' => 'mary@ann.com',
            'cpf'   => '75210809048'
        ];

        $route = action('UserController@destroy', ['id' => $jhonDoe->id]);

        $this->actingAs($jhonDoe)
            ->putJson($route, $newInfo)
            ->assertSuccessful()
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('users', $newInfo);
    }

    /** @test */
    public function it_should_require_a_valid_bearer_token_to_update()
    {
        $jhonDoe = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => $jhonDoe->id]);

        $this->putJson($route, ['name' => 'Mary Ann'])
            ->assertUnauthorized();

        $this->assertDatabaseHas('users', ['name' => $jhonDoe->name]);
    }

    public function it_should_prevent_to_update_a_user_with_a_invalid_id()
    {
        $jhonDoe = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => 999]);

        $this->putJson($route, ['name' => 'Mary Ann'])
            ->assertNotFound();

        $this->assertDatabaseHas('users', ['name' => $jhonDoe->name]);
    }

    /** @test */
    public function it_should_require_a_name_to_update()
    {
        $jhonDoe = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => $jhonDoe->id]);

        $response = $this->actingAs($jhonDoe)
            ->putJson($route, ['name' => ''])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('name', $content);
    }

    public function it_should_prevent_to_update_if_a_name_has_more_than_255_characters()
    {
        $jhonDoe = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => $jhonDoe->id]);

        $response = $this->actingAs($jhonDoe)
            ->putJson($route, ['name' => Str::random(256)])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('name', $content);
    }

    /** @test */
    public function it_should_require_an_email_to_update()
    {
        $jhonDoe = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => $jhonDoe->id]);

        $response = $this->actingAs($jhonDoe)
            ->putJson($route, ['email' => ''])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('email', $content);
    }

    /** @test */
    public function it_should_require_a_valid_email_to_update()
    {
        $jhonDoe = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => $jhonDoe->id]);

        $response = $this->actingAs($jhonDoe)
            ->putJson($route, ['email' => 'mary@.com'])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('email', $content);
    }

    /** @test */
    public function it_should_require_a_cpf_to_update()
    {
        $jhonDoe = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => $jhonDoe->id]);

        $response = $this->actingAs($jhonDoe)
            ->putJson($route, ['cpf' => ''])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('cpf', $content);
    }

    /** @test */
    public function it_should_require_a_valid_cpf_to_update()
    {
        $jhonDoe = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => $jhonDoe->id]);

        $response = $this->actingAs($jhonDoe)
            ->putJson($route, ['cpf' => Str::random(11)])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $content = $this->jsonToArray($response->getContent());

        $this->assertArrayHasKey('cpf', $content);
    }

    protected function jsonToArray($content)
    {
        return json_decode($content, true)['errors'];
    }
}

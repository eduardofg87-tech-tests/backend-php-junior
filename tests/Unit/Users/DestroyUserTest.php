<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DestroyUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_be_possible_to_delete_a_user()
    {
        $johnDoe = factory(User::class)->create();
        $maryAnn = factory(User::class)->create();

        $route = action('UserController@destroy', ['id' => $maryAnn->id]);

        $this->actingAs($johnDoe)
            ->deleteJson($route)
            ->assertSuccessful()
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('users', ['id' => $maryAnn->id]);
    }

    /** @test */
    public function it_should_require_a_valid_bearer_token_to_destroy_a_user()
    {
        $maryAnn = factory(User::class)->create();
        $route   = action('UserController@destroy', ['id' => $maryAnn->id]);

        $this->deleteJson($route)
            ->assertUnauthorized();
    }

    /** @test */
    public function it_should_prevent_to_delete_a_user_with_an_invalid_id()
    {
        $johnDoe = factory(User::class)->create();

        $route = action('UserController@destroy', ['id' => 999]);

        $this->actingAs($johnDoe)
            ->deleteJson($route)
            ->assertNotFound();
    }

    /** @test */
    public function it_should_prevent_to_delete_the_currently_sign_in_user()
    {
        $johnDoe = factory(User::class)->create();

        $route = action('UserController@destroy', ['id' => $johnDoe->id]);

        $this->actingAs($johnDoe)
            ->deleteJson($route)
            ->assertForbidden();

        $this->assertDatabaseHas('users', ['id' => $johnDoe->id]);
    }
}

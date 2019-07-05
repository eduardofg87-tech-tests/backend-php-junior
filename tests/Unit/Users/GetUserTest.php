<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_be_possible_get_a_user_info()
    {
        $johnDoe = factory(User::class)->create();
        $maryAnn = factory(User::class)->create();

        $route = action('UserController@show', ['id' => $maryAnn->id]);

        $this->actingAs($johnDoe)
            ->getJson($route)
            ->assertSuccessful()
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson($maryAnn->toArray());
    }

    /** @test */
    public function it_should_prevent_to_see_user_info_if_no_token_is_sent()
    {
        $maryAnn = factory(User::class)->create();

        $route = action('UserController@show', ['id' => $maryAnn->id]);

        $this->getJson($route)
            ->assertUnauthorized();
    }
}

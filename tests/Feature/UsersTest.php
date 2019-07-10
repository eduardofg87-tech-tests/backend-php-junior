<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testApiIndex()
    {
        $data = factory(User::class, 10)->create();
        $response = $this->get('/api/users');
        $response->assertStatus(200)
            ->assertJson(['data' => $data->toArray()]);
    }

    public function testApiShow()
    {
        $data = factory(User::class)->create();
        $response = $this->get("/api/users/$data->id");
        $response->assertStatus(200)
            ->assertExactJson($data->toArray());
    }

}

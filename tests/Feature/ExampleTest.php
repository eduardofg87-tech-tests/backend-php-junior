<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDataBaseUsers()
    {
        factory(User::class)->create([
            'email' => 'teste@teste.com.br',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'teste@teste.com.br',
        ]);
    }
}

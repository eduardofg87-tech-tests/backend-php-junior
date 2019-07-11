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
    public function test_it_can_list_users()
    {
        $data = factory(User::class, 10)->create();
        
        $this->get('/api/users')
            ->assertStatus(200)
            ->assertJson(['data' => $data->toArray()]);
    }

    public function test_it_can_show_an_user()
    {
        $data = factory(User::class)->create();
        
        $this->get("/api/users/$data->id")
            ->assertStatus(200)
            ->assertExactJson($data->toArray());
    }

    public function test_it_can_create_an_user()
    {
        $data = factory(User::class)->raw();
        
        $this->postJson("/api/users", $data)
            ->assertStatus(201)
            ->assertJson([
                'name' => $data['name'],
                'cpf' => $data['cpf'],
                'email' => $data['email'],
                'updated_at' => true,
                'created_at' => true,
                'id' => true,
            ]);
        
        $this->assertDatabaseHas('users', [
            'name'  => $data['name'],
            'email' => $data['email'],
            'cpf'   => $data['cpf'],
        ]);
    }

    public function test_it_can_update_an_user()
    {
        $data = factory(User::class)->create();
        
        $dataToUpdate = factory(User::class)->raw();
        
        $this->putJson("/api/users/$data->id", $dataToUpdate)
            ->assertStatus(200)
            ->assertJson([
                'id' => true,
                'name' => $dataToUpdate['name'],
                'cpf' => $dataToUpdate['cpf'],
                'email' => $dataToUpdate['email'],
                'email_verified_at' => true,
                'updated_at' => true,
                'created_at' => true,
            ]);

        $this->assertDatabaseHas('users', [
            'name'  => $dataToUpdate['name'],
            'email' => $dataToUpdate['email'],
            'cpf'   => $dataToUpdate['cpf'],
        ]);
    }

    public function test_it_can_delete_an_user()
    {
        $data = factory(User::class)->create();
                
        $this->deleteJson("/api/users/$data->id")
            ->assertStatus(200)
            ->assertJson([
                'id' => true,
                'name' => $data['name'],
                'cpf' => $data['cpf'],
                'email' => $data['email'],
                'email_verified_at' => true,
                'updated_at' => true,
                'created_at' => true,
            ]);
        
        $this->assertDatabaseMissing('users', [
            'name'  => $data->name,
            'email' => $data->email,
            'cpf'   => $data->cpf,
        ]);
    }

}

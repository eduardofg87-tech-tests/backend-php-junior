<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'name'     => 'John Doe',
            'email'    => 'john@doe.com',
            'password' => '12345678'
        ]);
    }
}

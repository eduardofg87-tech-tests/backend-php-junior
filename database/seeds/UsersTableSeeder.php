<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate(); 
        User::create([ 
            'name' => 'Programador Backend PHP Júnior',
            'cpf' => '11122233344',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);
    }
}

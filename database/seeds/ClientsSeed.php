<?php

use Illuminate\Database\Seeder;

class ClientsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Clients::class, 30)->create();
    }
}

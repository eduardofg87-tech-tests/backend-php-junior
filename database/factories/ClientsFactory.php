<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Clients::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'cpf'  => $faker->numberBetween(11111111111, 99999999999),
        'email' => $faker->email()
    ];
});

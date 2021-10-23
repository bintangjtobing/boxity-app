<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\messages;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(messages::class, function (Faker $faker) {
    do {
        $from = rand(1, 8);
        $to = rand(1, 8);
    } while (
        $from == $to
    );
    return [
        'from' => $from,
        'to' => $to,
        'text' => $faker->sentence,
    ];
});

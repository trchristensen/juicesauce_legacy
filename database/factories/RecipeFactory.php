<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'description'   => $faker->unique()->paragraph,
        'owner_id' => factory(App\User::class)
    ];
});

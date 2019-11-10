<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Flavor;
use Faker\Generator as Faker;

$factory->define(Flavor::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->sentence,
        
    ];
});

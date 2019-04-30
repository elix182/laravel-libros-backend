<?php

use Faker\Generator as Faker;

$factory->define(App\Autor::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'nacionalidad' => $faker->country,
        'biografia' => $faker->realText($maxNbChars = 200)
    ];
});

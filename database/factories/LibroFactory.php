<?php

use Faker\Generator as Faker;

$factory->define(App\Libro::class, function (Faker $faker) {
    return [
        'titulo' => $faker->catchPhrase,
        'fecha_publicacion' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'tipo' => $faker->word,
        'descripcion' => $faker->realText($maxNbChars = 200)
    ];
});

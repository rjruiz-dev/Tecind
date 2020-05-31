<?php

use Faker\Generator as Faker;

$factory->define(App\Statu::class, function (Faker $faker) {
    return [
          'statu'    => $faker->randomElement(['En proceso', 'Terminado', 'No terminado']),
          'color'    => $faker->randomElement(['#F39C12', '#27AE60', '#C0392B']),
    ];
});

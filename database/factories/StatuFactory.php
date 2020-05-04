<?php

use Faker\Generator as Faker;

$factory->define(App\Statu::class, function (Faker $faker) {
    return [
          'statu'    => $faker->randomElement(['En proceso', 'Terminado', 'No terminado']),
    ];
});

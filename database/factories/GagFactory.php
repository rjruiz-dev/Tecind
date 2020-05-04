<?php

use Faker\Generator as Faker;

$factory->define(App\Gag::class, function (Faker $faker) {
    return [        
        'number_gag'    => $faker->unique()->numberBetween($min = 00, $max = 100),
        'diameter'      => $faker->numberBetween($min = 00, $max = 200),
        'type_gag'      => $faker->randomElement(['EXTERIOR', 'INTERIOR']),
        'category_gag'  => $faker->randomElement(['PASANTE', 'CON TOPE']),        
    ];
});

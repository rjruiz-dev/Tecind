<?php

use Faker\Generator as Faker;

$factory->define(App\Program::class, function (Faker $faker) {
    return [
        'name_program'    => $faker->word,
        'number_program'  => $faker->unique()->numberBetween($min = 0000, $max = 1000),
        'part_program'    => $faker->numberBetween($min = 00, $max = 06),        
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Insert::class, function (Faker $faker) {
    return [            
        'code_insert'          => $faker->postcode,       
        'quality'              => $faker->unique()->numberBetween($min = 0000, $max = 2000),  
        // 'type_insert'          => $faker->randomElement(['EXTERIOR', 'INTERIOR']),
        // 'category_insert'      => $faker->randomElement(['DESBASTE', 'TERMINACIÓN', 'RANURADO', 'ROSCADO', 'TRONZADO', 'PERFORADO']),
        // 'status_insert'        => $faker->randomElement(['DISPONIBLE', 'NO DISPONIBLE']),
        // 'description_insert'   => $faker->word,
        // 'reason_insert'        => $faker->word,
    ];
});

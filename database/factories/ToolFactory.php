<?php

use Faker\Generator as Faker;

$factory->define(App\Tool::class, function (Faker $faker) {
    return [
        // 'insert_id'          => factory(App\Insert::class)->create()->id,   
        // 'position'           => $faker->unique()->numberBetween($min = 00, $max = 12),    
        'tool'                  => $faker->postcode,         
        // 'type_tool'          => $faker->randomElement(['EXTERIOR', 'INTERIOR']),
        // 'category_tool'      => $faker->randomElement(['DESBASTE', 'TERMINACIÓN', 'RANURADO', 'ROSCADO', 'TRONZADO', 'PERFORADO']),
        // 'status_tool'        => $faker->randomElement(['DISPONIBLE', 'NO DISPONIBLE']),
        // 'description_tool'   => $faker->word,
        // 'reason_tool'        => $faker->word,
    ];
});

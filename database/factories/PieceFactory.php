<?php

use Faker\Generator as Faker;

$factory->define(App\Piece::class, function (Faker $faker) {
    return [             
        'program_id'    => factory(App\Program::class)->create()->id,   
        'gag_id'        => factory(App\Gag::class)->create()->id,          
        'machine_id'    => factory(App\Machine::class)->create()->id, 
        'user'          => $faker->randomElement(['Miguel', 'Javier', 'Jose', 'Alejandro']),
        'order_id'      => factory(App\Order::class)->create()->id,        
        'code'          => $faker->randomNumber($nbDigits = NULL, $strict = false),   
        'part_piece'    => $faker->numberBetween($min = 00, $max = 06),        
        'time'          => $faker->time($format = 'H:i:s', $max = 'now'),   
        'observation'   => $faker->sentence(2),        
    ];
});

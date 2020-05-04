<?php

use Faker\Generator as Faker;

$factory->define(App\Time::class, function (Faker $faker) {
    return [        
        'order_id'          => factory(App\Order::class)->create()->id,       
        'machine_id'        => factory(App\Machine::class)->create()->id,       
        'denomination'      => $faker->word,
        'code'              => $faker->unique()->postcode,   
        'user'              => $faker->randomElement(['Miguel', 'Javier', 'Jose', 'Alejandro']),   
        'date'              => $faker->date($format = 'Y-m-d', $max = 'now'),        
        'quantity'          => $faker->numberBetween($min = 00, $max = 100),        
        'preparation_time'  => $faker->time($format = 'H:i:s', $max = 'now'),   
        'machining_time'    => $faker->time($format = 'H:i:s', $max = 'now'),   
        'observation'       => $faker->sentence(2),    
    ];
});

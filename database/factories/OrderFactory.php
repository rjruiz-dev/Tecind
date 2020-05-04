<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [        
        'order'         => $faker->unique()->numberBetween($min = 00000, $max = 100000),  
        'denomination'  => $faker->word,
        'reason'        => $faker->word,
        'code'          => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),    
        'quantity'      => $faker->numberBetween($min = 00, $max = 200),        
        // 'status'        => $faker->randomElement(['EN PROCESO', 'TERMINADO', 'NO TERMINADO']),
        'date' 			=> $faker->date($format = 'Y-m-d', $max = 'now'),         
        'client_id'     => factory(App\Client::class)->create()->id, 
        'user_id'       => factory(App\User::class)->create()->id,  
        'statu_id'      => factory(App\Statu::class)->create()->id   
                 
    ];
});

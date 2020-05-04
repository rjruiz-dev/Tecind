<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [       
        'name_client'  => $faker->randomElement(['Mariano', 'Juan', 'Daniel', 'Gonzalo', 'Marcos']),
        'lastname'     => $faker->randomElement(['Pardo', 'Perez', 'Gonzales', 'Pintos', 'Castillo']),
        'address'      => $faker->secondaryAddress,
        'city'         => $faker->city,
        'province'     => $faker->state,
        'postal_code'  => $faker->postcode,
        'country'      => $faker->country,
        'phone_client' => $faker->e164PhoneNumber,
        'email'        => $faker->unique()->email, 
        'created_at'   => $faker->date($format = 'Y-m-d', $max = 'now'),    
    ];
});

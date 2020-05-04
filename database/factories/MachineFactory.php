<?php

use Faker\Generator as Faker;

$factory->define(App\Machine::class, function (Faker $faker) {
    return [
        'user_id'       => factory(App\User::class)->create()->id,          
        'machine'       => $faker->randomElement(['HASS', 'TURRI T5', 'ROMI G280']),     
        'category_maq'  => $faker->randomElement(['TORNO', 'FRESADORA', 'PERFORADORA']),     
    ];
});

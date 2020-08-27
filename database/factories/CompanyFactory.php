<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [              
        'name_company'  => $faker->randomElement(['Famiq', 'Espaqfe', 'Ferca', 'Sca']),
        'cuit'          => $faker->unique()->phoneNumber,
        'web'           => $faker->url,
        'phone_company' => $faker->e164PhoneNumber, 
        'client_id'     => factory(App\Client::class)->create()->id,
       
    ];
});

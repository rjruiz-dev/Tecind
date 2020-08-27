<?php

use Illuminate\Database\Seeder;


class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        factory(App\Client::class, 1)->create()->each(function ($client) {
          
            $company = factory(App\Company::class)->make();
            $client->company()->save($company);

            // Seed the relation with 5 purchases
            $orders = factory(App\Order::class, 1)->make();
            $client->orders()->saveMany($orders);
        
        });
    }
}

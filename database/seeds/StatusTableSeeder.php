<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Statu::create([           
            'statu'           => 'En proceso',
            'color'           => '#F39C12',            
        ]);

        App\Statu::create([           
            'statu'           => 'Terminado',
            'color'           => '#27AE60',            
        ]);

        App\Statu::create([           
            'statu'           => 'No terminado',
            'color'           => '#C0392B',            
        ]);        
    }
}

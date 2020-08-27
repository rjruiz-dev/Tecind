<?php

use Illuminate\Database\Seeder;

class GagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Gag::create([           
            'number_gag'        => '5',
            'diameter'          => '16',     
            'type_gag'          => 'EXTERIOR',   
            'category_gag'      => 'PASANTE',   

        ]);

        App\Gag::create([           
            'number_gag'        => '10',
            'diameter'          => '19',
            'type_gag'          => 'EXTERIOR',
            'category_gag'      => 'PASANTE',      
        ]);

        App\Gag::create([           
            'number_gag'        => '15',
            'diameter'          => '24',      
            'type_gag'          => 'EXTERIOR',    
            'category_gag'      => 'PASANTE',        
        ]);

        App\Gag::create([           
            'number_gag'        => '20',
            'diameter'          => '28',
            'type_gag'          => 'EXTERIOR', 
            'category_gag'      => 'PASANTE',                 
        ]);

        App\Gag::create([           
            'number_gag'        => '25',
            'diameter'          => '35',
            'type_gag'          => 'EXTERIOR', 
            'category_gag'      => 'CON TOPE',                 
        ]);

        App\Gag::create([           
            'number_gag'        => '30',
            'diameter'          => '45', 
            'type_gag'          => 'INTERIOR', 
            'category_gag'      => 'CON TOPE',              
        ]);
        App\Gag::create([           
            'number_gag'        => '35',
            'diameter'          => '12',  
            'type_gag'          => 'EXTERIOR',   
            'category_gag'      => 'PASANTE',           
        ]);

        App\Gag::create([           
            'number_gag'        => '40',
            'diameter'          => '38',
            'type_gag'          => 'EXTERIOR', 
            'category_gag'      => 'CON TOPE',               
        ]);

        App\Gag::create([           
            'number_gag'        => '45',
            'diameter'          => '20',
            'type_gag'          => 'INTERIOR', 
            'category_gag'      => 'PASANTE',               
        ]);

        App\Gag::create([           
            'number_gag'        => '45',
            'diameter'          => '14',
            'type_gag'          => 'EXTERIOR', 
            'category_gag'      => 'CON TOPE',               
        ]);

        App\Gag::create([           
            'number_gag'        => '50',
            'diameter'          => '38',
            'type_gag'          => 'EXTERIOR', 
            'category_gag'      => 'PASANTE',               
        ]);
    }
}

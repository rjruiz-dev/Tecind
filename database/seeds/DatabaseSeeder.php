<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(CustomersTableSeeder::class);               
        // $this->call(OrdersTableSeeder::class);
        $this->call(GagsTableSeeder::class);
        // $this->call(ProgramsTableSeeder::class);
        // $this->call(InsertsTableSeeder::class);
        // $this->call(ToolsTableSeeder::class);                
        // $this->call(PiecesTableSeeder::class); 
        // $this->call(TimeTableSeeder::class);    
        $this->call(StatusTableSeeder::class);                  
        $this->call(PostsTableSeeder::class);      
    }
}

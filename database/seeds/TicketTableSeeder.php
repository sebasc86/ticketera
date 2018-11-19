<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            'status' => rand(0, 1),
            'queue' => rand(1, 2),
            'sector' => 'prueba',
            'title' => str_random(10),
            'number' =>20011209,
            'user_id' => 2

        ]);
        
    }
}

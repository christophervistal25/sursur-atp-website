<?php

use App\President;
use Illuminate\Database\Seeder;

class PresidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        President::create([
        	'email' => 'president@yahoo.com',
        	'name' => 'President',
        	'address' => 'Tandag City',
        	'password' => bcrypt('password'),
        ]);
    }
}

<?php

use App\Municipal;
use Illuminate\Database\Seeder;

class MunicipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Municipal::create([
            'username'      => 'user',
            'phone_number'  => '09663765072',
            'city_code' => '166819000',
            'password'      => bcrypt('christopher'),
        ]);
    }
}

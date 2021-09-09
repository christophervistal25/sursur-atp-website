<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'username'   => 'admin',
            'firstname'  => 'Christopher',
            'middlename' => 'Platino',
            'lastname'   => 'Vistal',
            'phone_number' => '09193693499',
            'password'   => bcrypt('christopher'),
        ]);
    }
}

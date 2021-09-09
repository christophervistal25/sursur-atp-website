<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'default_MPIN',
            'value' => bcrypt('1234'),
        ]);

        Setting::create([
            'name' => 'default_password',
            'value' => bcrypt('pa$$w0rD!'),
        ]);
    }
}

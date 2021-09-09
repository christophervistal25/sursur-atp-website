<?php

use Illuminate\Database\Seeder;
use App\City;
use App\Barangay;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = glob(public_path() . '\data-need\cities\municipal.csv');
        $data = file_get_contents($data[0]);
        $data = array_filter(explode("\n", $data));

        foreach($data as $key => $city) {

            // Excluse the header
            if($key !== 0) {
                list($province_code, $code, $name, $type, $classification, $ruralOrUrban, $population) = explode("|", $city);
                if(strlen($province_code) !== strlen($code)) {
                    echo $province_code . " => " . $code . "\n";
                }
                City::create([
                    'province_code'         => (string) $province_code,
                    'code'                  => (string) $code,
                    'name'                  => (string) $name,
                    'income_classification' => $classification,
                    'population'            => str_replace("\r", "", $population)
                ]);
            }

            
        }

    }
}

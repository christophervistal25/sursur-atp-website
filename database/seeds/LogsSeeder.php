<?php

use Illuminate\Database\Seeder;
use App\PersonLog;
use App\Person;
use App\Checker;
use App\City;
use Carbon\Carbon;

class LogsSeeder extends Seeder
{
    private function randFloat($st_num = 0, $end_num = 1, $mul = 1000000)
    {
        if($st_num > $end_num) {
            return false;
        }
        return mt_rand($st_num * $mul, $end_num * $mul) / $mul;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(0, Person::count()) as $range) {
            $person   = Person::get()->random();

            $purposes = ['Visitor', 'Employee', 'Customer', 'Student', 'Shopper', 'Passenger'];

            $city = City::get()->random()->name;

            $checker = Checker::get()->random()->id;

            PersonLog::create([
                'person_id'        => $person->id,
                'location'         => $city,
                'checker_id'       => $checker,
                'body_temperature' => $this->randFloat(36, 45, 10),
                'purpose'          => $purposes[rand(0, count($purposes) - 1)],
                'time'             => Carbon::now()->format('d-m-Y h-i-A'),
            ]);
        }

    }
}

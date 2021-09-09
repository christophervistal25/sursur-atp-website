<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PersonLog;
use App\Http\Controllers\Repositories\PersonLogRepository;
use App\Person;
use Auth;

class PersonnelChartController extends Controller
{
    public function temperature()
    {

        // Query for Low Normal to High Normal
        $normal = PersonLogRepository::getLogsByTemperatureRange(PersonLog::LOW_NORMAL, PersonLog::HIGH_NORMAL);

        // Query for Low Fever to High Fever
        $fever = PersonLogRepository::getLogsByTemperatureRange(PersonLog::LOW_FEVER, PersonLog::HIGH_FEVER);

        // Query for Low Severe to High Severe
        $severe = PersonLogRepository::getLogsByTemperatureRange(PersonLog::LOW_SEVERE, PersonLog::HIGH_SEVERE);

        $female = Person::has('logs')->where('gender', 'female')->count();
        $male   = Person::has('logs')->where('gender', 'male')->count();

        $minAge = 10;

        $maxAgeInRecords = Person::max('age');

        // Round down
        $roundedAge  = (int) (floor($maxAgeInRecords / 10) * 10);

        $sizePerBracket = 10;

        // Array chunk for creating age bracket by $sizePerBracket
        $ageBrackets = array_chunk(range($minAge, $roundedAge), $sizePerBracket);


        // Removing last element of the age bracket which is the $maxAge above.
        $lastElement = count($ageBrackets) - 1;
        unset($ageBrackets[ $lastElement ]);

        $personsByAgeBracket = [];


        $minAgeBelow  = Person::where('age', '<=', 9)->count();
        $personsByAgeBracket['9_Below'] = $minAgeBelow;

        // Getting between min and max age
        foreach($ageBrackets as $bracket) {

            $currentBracketMinAge = min($bracket);
            $currentBracketMaxAge = max($bracket);


            $personsByAgeBracket[$currentBracketMinAge . '_' . $currentBracketMaxAge] = Person::whereBetween('age', [$currentBracketMinAge, $currentBracketMaxAge])
                            ->count();
        }

        $maxAgeAbove = Person::where('age', '>=', $roundedAge)->count();

        $personsByAgeBracket[ $roundedAge . '_Above'] = $maxAgeAbove;

        $temporaryPersonsByAge = array_filter($personsByAgeBracket);

        return response()->json([
            'Normal - (' .  PersonLog::LOW_NORMAL  . ' - ' . PersonLog::HIGH_NORMAL . ')'    =>  $normal,
            'Fever - ('  .  PersonLog::LOW_FEVER  . ' - ' . PersonLog::HIGH_FEVER . ')'      => $fever,
            'Severe - (' .  PersonLog::LOW_SEVERE  . ' - ' . PersonLog::HIGH_SEVERE . ')'    => $severe,
            'gender' => [
                'Male'   => $male,
                'Female' => $female,
                '&nbsp;' => '&nbsp;'
            ],
           'user_bracket_by_age' => !empty($temporaryPersonsByAge) ? $personsByAgeBracket : [],
        ]);
    }

    public function municipalAnalytics(string $id)
    {

         // Query for Low Normal to High Normal
         $normal = PersonLogRepository::getLogsByTemperatureRange(PersonLog::LOW_NORMAL, PersonLog::HIGH_NORMAL, $id);

         // Query for Low Fever to High Fever
         $fever = PersonLogRepository::getLogsByTemperatureRange(PersonLog::LOW_FEVER, PersonLog::HIGH_FEVER, $id);

         // Query for Low Severe to High Severe
         $severe = PersonLogRepository::getLogsByTemperatureRange(PersonLog::LOW_SEVERE, PersonLog::HIGH_SEVERE, $id);

         $female = Person::has('logs')->where('city_code', $id)->where('gender', 'female')->count();
         $male   = Person::has('logs')->where('city_code', $id)->where('gender', 'male')->count();

         $minAge = 10;

         $maxAgeInRecords = Person::where('city_code', $id)->max('age');

         // Round down
         $roundedAge  = (int) (floor($maxAgeInRecords / 10) * 10);

         $sizePerBracket = 10;

         // Array chunk for creating age bracket by $sizePerBracket
         $ageBrackets = array_chunk(range($minAge, $roundedAge), $sizePerBracket);


         // Removing last element of the age bracket which is the $maxAge above.
         $lastElement = count($ageBrackets) - 1;
         unset($ageBrackets[ $lastElement ]);

         $personsByAgeBracket = [];


         $minAgeBelow  = Person::where('city_code', $id)->where('age', '<=', 9)->count();
         $personsByAgeBracket['9_Below'] = $minAgeBelow;

         // Getting between min and max age
         foreach($ageBrackets as $bracket) {

             $currentBracketMinAge = min($bracket);
             $currentBracketMaxAge = max($bracket);


             $personsByAgeBracket[$currentBracketMinAge . '_' . $currentBracketMaxAge] = Person::where('city_code', $id)->whereBetween('age', [$currentBracketMinAge, $currentBracketMaxAge])
                             ->count();
         }

         $maxAgeAbove = Person::where('city_code', $id)->where('age', '>=', $roundedAge)->count();

         $personsByAgeBracket[ $roundedAge . '_Above'] = $maxAgeAbove;

         $temporaryPersonsByAge = array_filter($personsByAgeBracket);


        return response()->json([
            'Normal - (' .  PersonLog::LOW_NORMAL  . ' - ' . PersonLog::HIGH_NORMAL . ')'    =>  $normal,
            'Fever - ('  .  PersonLog::LOW_FEVER  . ' - ' . PersonLog::HIGH_FEVER . ')'      => $fever,
            'Severe - (' .  PersonLog::LOW_SEVERE  . ' - ' . PersonLog::HIGH_SEVERE . ')'    => $severe,
            'gender' => [
                'Male'   => $male,
                'Female' => $female,
                '&nbsp;' => '&nbsp;'
            ],
           'user_bracket_by_age' => !empty($temporaryPersonsByAge) ? $personsByAgeBracket : [],
        ]);
    }
}

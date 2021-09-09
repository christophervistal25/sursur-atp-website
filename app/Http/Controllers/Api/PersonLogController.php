<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\PersonnelRepository;
use App\PersonLog;
use App\Person;
use App\Barangay;
use Carbon\Carbon;
use DB;
use Exception;

class PersonLogController extends Controller
{

    public function __construct(PersonnelRepository $personnelRepo)
    {
        $this->personnelRepository = $personnelRepo;
    }

    public function scanned(Request $request)
    {
        // Check if user is registered from mobile or website.
        if(strtoupper($request->registered_from) === 'MOBILE') {
            // Update the temporary address and permanent address of the user.
            DB::beginTransaction();
            try {
                $person = Person::find($request->user_id);
                if($person->address === '*' || $person->address ===  '' || $person->civil_status === '*' || $person->civil_status === '') {
                    // Update the address of the user
                    $person->address           = $request->address;
                    $person->temporary_address = $request->address;
                    $person->civil_status      = $request->civil_status;
                    $person->save();
                }

                PersonLog::create([
                    'person_id'        => $person->id,
                    'location'         => $request->location,
                    'checker_id'       => $request->checker_id,
                    'purpose'          => $request->purpose,
                    'body_temperature' => $request->temperature,
                    'time'             => $request->time,
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        } else {
            PersonLog::create([
                'person_id'        => $request->user_id,
                'location'         => $request->location,
                'checker_id'       => $request->checker_id,
                'purpose'          => $request->purpose,
                'body_temperature' => $request->temperature,
                'time'             => $request->time,
            ]);
        }


        return response()->json(['code' => 200, 'message' => 'success']);
    }

    public function addMultiple(Request $request)
    {
        $records = json_decode($request->data, true);
        foreach($records as $log) {
            if(strtoupper($log['registered_from']) === 'MOBILE') {
                // Update the temporary address and permanent address of the user.
                try {
                    $person = Person::find($log['person_second_id']);
                    // if($person->address === '*' || $person->address ===  '' || $person->civil_status === '*' || $person->civil-status === '') {
                        // Update the address of the user
                        $person->address           = $log['address'];
                        $person->temporary_address = $log['address'];
                        $person->civil_status      = $log['civil_status'];
                        $person->save();
                    // }

                    PersonLog::create([
                        'person_id'        => $log['person_second_id'],
                        'location'         => $log['location'],
                        'checker_id'       => $log['checker_id'],
                        'purpose'          => $log['purpose'],
                        'body_temperature' => $log['body_temperature'],
                        'time'             => $log['time'],
                    ]);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
            } else {
                PersonLog::create([
                    'person_id'        => $log['person_second_id'],
                    'location'         => $log['location'],
                    'checker_id'       => $log['checker_id'],
                    'purpose'          => $log['purpose'],
                    'body_temperature' => $log['body_temperature'],
                    'time'             => $log['time'],
                ]);
            }

        }

        return response()->json(
            [
                'code' => 200, 'message' => 'Successfully add all the records.'
            ]
        );
    }
}

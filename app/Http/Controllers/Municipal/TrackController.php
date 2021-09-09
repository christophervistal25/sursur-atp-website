<?php

namespace App\Http\Controllers\Municipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Person;
use Freshbitsweb\Laratables\Laratables;
use Auth;
use Carbon\Carbon;
use App\PersonLog;
use App\SMS;

class TrackController extends Controller
{
    public function find()
    {
        $city_code = Auth::user()->city_code;
        return Laratables::recordsOf(Person::class, function ($query) use($city_code) {
            return $query->with('logs')->where('city_code', $city_code);
        });
    }

    public function index()
    {
        return view('municipal.track.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::with(['logs'])->find($id);
        return view('municipal.track.show', compact('person'));
    }

    public function track($id)
    {
        if(request()->ajax()) {
            $log  = PersonLog::find($id);

            // For deployment
            $time = Carbon::parse($log->time)->format('d-m-y');

            // For developing purpose
            // $time = Carbon::parse($log->time)->format('d-m-Y');

            return PersonLog::with(['person:id,person_id,firstname,middlename,lastname,suffix,phone_number,image', 'checker'])
                            ->where('time', 'like', $time . '%')
                            ->where('location', $log->location)
                            ->where('person_id', '!=', $log->person_id)
                            ->get()
                            ->unique('person_id');

        }
    }

    public function notify(Request $request)
    {
        $message = "You are notified having been exposed to a COVID-19 positive suspect kindly submit and coordinate with your barangay health worker for guidance. \n" . "Thank you.\n";

        $phoneNumbers = explode(',', $request->phone_numbers);

        foreach(array_filter($phoneNumbers) as $mobileNumber) {
            SMS::create([
                'phone_number' => $mobileNumber,
                'message'      =>  strtoupper($message) . "SURSUR-ATP\n" . $request->location . "\n" . $request->time . "\n",
            ]);
        }

        return back()->with('success', 'Successfully load all persons to nofitication process.');
    }
}

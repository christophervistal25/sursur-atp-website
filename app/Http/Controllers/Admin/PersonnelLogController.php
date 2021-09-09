<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;
use Auth;
use App\City;
use App\Barangay;
use App\Province;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Repositories\PersonnelRepository;

class PersonnelLogController extends Controller
{
    /**
     * @id Person ID
     */
    public function show($id)
    {
        $person = Person::with('logs')->find($id);

        $provinces = Province::get();

        $cities = City::where('province_code', $person->province_code)
                        ->get();

        $barangays = Barangay::where('province_code', $person->province_code)
                ->get();

        $civil_status = PersonnelRepository::CIVIL_STATUS;

        return view('admin.personnel_logs.show', compact('person', 'provinces', 'civil_status', 'cities', 'barangays'));
    }

    public function update(Request $request, Person $id)
    {

        // Validation first.
        $this->validate($request, [
            'firstname'         => 'required',
            'middlename'        => 'required',
            'lastname'          => 'required',
            'date_of_birth'     => 'required|date',
            'temporary_address' => 'required',
            'address'           => 'required',
            'phone_number'      => 'required',
            'province'          => 'required|exists:provinces,code',
            'city'              => 'required|exists:cities,code',
            'barangay'          => 'required:exists:barangays,code',
            'gender'            => 'required|in:male,female',
            'civil_status'      => 'required|in:' . implode(',', PersonnelRepository::CIVIL_STATUS),
        ]);


        // Update the Person.
        $person                    = $id;
        $person->firstname         = $request->firstname;
        $person->middlename        = $request->middlename;
        $person->lastname          = $request->lastname;
        $person->suffix            = $request->suffix;
        $person->date_of_birth     = $request->date_of_birth;
        $person->address           = $request->address;
        $person->temporary_address = $request->temporary_address;
        $person->province_code     = $request->province;
        $person->city_code         = $request->city;
        $person->barangay_code     = $request->barangay;
        $person->gender            = $request->gender;
        $person->civil_status      = $request->civil_status;
        $person->phone_number      = $request->phone_number;
        $person->landline_number   = $request->landline_number;
        $person->save();



        // Redirect back.

        return redirect()->route('personnel.logs', $person->id)->with('success', 'Successfully update personnel information.');
    }
}

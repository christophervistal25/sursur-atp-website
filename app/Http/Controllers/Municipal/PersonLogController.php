<?php

namespace App\Http\Controllers\Municipal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;
use Auth;
use App\Province;
use App\City;
use App\Barangay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Repositories\PersonnelRepository;


class PersonLogController extends Controller
{


    public function __construct(PersonnelRepository $personnelRepository)
    {
        $this->personnelRepository = $personnelRepository;
    }

    public function get($id)
    {
        return Person::with('logs')->find($id);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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

        return view('municipal.personnel_logs.show', compact('person', 'provinces', 'civil_status', 'cities', 'barangays'));

        // return view('municipal.personnel_logs.show', compact('person', 'barangays'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {

        $this->validate($request, [
            'firstname'         => 'required',
            'middlename'        => 'required',
            'lastname'          => 'required',
            'date_of_birth'     => 'required|date',
            'gender'            => 'required|in:' . implode(',', PersonnelRepository::GENDER),
            'temporary_address' => 'required',
            'phone_number'      => 'required|unique:people,phone_number,' . $person->id,
            'address'           => 'required',
            'civil_status'      => 'required',
            'barangay'          => 'required|exists:barangays,code',
        ]);

        $barangay = Barangay::where('code', $request->barangay)->first();

        $person->firstname         = $request->firstname;
        $person->middlename        = $request->middlename;
        $person->lastname          = $request->lastname;
        $person->temporary_address = $request->temporary_address;
        $person->address           = $request->address;
        $person->suffix            = $request->suffix;
        $person->date_of_birth     = Carbon::parse($request->date_of_birth)->format('Y-m-d');
        $person->gender            = $request->gender;
        $person->province_code     = $barangay->province_code;
        $person->city_code         = $barangay->city_code;
        $person->barangay_code     = $barangay->code;
        $person->civil_status      = $request->civil_status;
        $person->phone_number      = $request->phone_number;
        $person->landline_number   = $request->landline_number;
        $person->age               = $this->personnelRepository
                                           ->getAge($request->date_of_birth);
        $person->save();

        return back()->with('success', 'Successfully update personnel information.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

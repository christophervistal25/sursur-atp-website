<?php

namespace App\Http\Controllers\Municipal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Establishment;
use App\City;
use App\Http\Controllers\Repositories\EstablishmentRepository;
use App\Barangay;
use Auth;
use Freshbitsweb\Laratables\Laratables;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establishments = Establishment::get();
        return view('municipal.establishment.index', compact('establishments'));
    }

    public function list()
    {
        return Laratables::recordsOf(Establishment::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = EstablishmentRepository::TYPES;
        $barangays = Auth::user()->barangays;
        return view('municipal.establishment.create', compact('types', 'barangays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'office_store_name' => 'required',
            'type'              => 'required|in:' . implode(',', EstablishmentRepository::TYPES),
            'address'           => 'required|max:100',
            'contact_number'    => 'required',
            'geo_tag_location'  => 'required',
            'barangay'          => 'required|exists:barangays,code',
        ], [], ['office_store_name' => 'name']);

        $barangay = Barangay::where('code', $request->barangay)->first();

        list($latitude, $longitude) = explode('&', $request->geo_tag_location);

        Establishment::create([
            'name'          => $request->office_store_name,
            'type'          => $request->type,
            'address'       => $request->address,
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'contact_no'    => $request->contact_number,
            'province_code' => $barangay->province_code,
            'city_code'     => $barangay->city_code,
            'barangay_code' => $barangay->code,
        ]);

        return redirect()->back()->with('success', 'Successfully create new establishment.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Establishment $m_establishment)
    {
        $establishment = $m_establishment;
        $types         = EstablishmentRepository::TYPES;
        $barangays     = Auth::user()->barangays;

        return view('municipal.establishment.edit', compact('establishment', 'types', 'barangays'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establishment $m_establishment)
    {
        $this->validate($request, [
            'name' => 'required',
            'type'              => 'required|in:' . implode(',', EstablishmentRepository::TYPES),
            'address'           => 'required|max:100',
            'contact_no'    => 'required|unique:establishments,contact_no,' . $m_establishment->id,
            'geo_tag_location'  => 'required',
            'barangay'          => 'required|exists:barangays,code',
        ], [], ['office_store_name' => 'name']);

        list($latitude, $longitude) = explode('&', $request->geo_tag_location);

        $barangay = Barangay::where('code', $request->barangay)->first();

        $m_establishment->name          = $request->name;
        $m_establishment->type          = $request->type;
        $m_establishment->address       = $request->address;
        $m_establishment->latitude      = $latitude;
        $m_establishment->longitude     = $longitude;
        $m_establishment->contact_no    = $request->contact_no;
        $m_establishment->province_code = $barangay->province_code;
        $m_establishment->city_code     = $barangay->city_code;
        $m_establishment->barangay_code = $barangay->code;
        $m_establishment->save();

        return redirect()->back()->with('success', 'Successfully update establishment.');

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

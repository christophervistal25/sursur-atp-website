<?php

namespace App\Http\Controllers;

use App\Person;
use App\Barangay;
use App\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Repositories\PersonnelRepository;

class UpdateProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $provinces = Province::get();

        $residenceOfTandagBarangays = Barangay::where('city_code', '166819000')->get(['name', 'code']);

        $civil_status = PersonnelRepository::CIVIL_STATUS;

        return view('user.update-profile', compact('user', 'provinces', 'civil_status', 'residenceOfTandagBarangays'));
    }

    public function update(Request $request)
    {
        $rules = [];

        $rules = [
            'gender'            => 'required|in:' . implode(',', PersonnelRepository::GENDER),
            'temporary_address' => 'required',
            'address'           => 'required',
            'barangay'          => 'required|exists:barangays,code',
            'status'            => 'required|in:' . implode(',', PersonnelRepository::CIVIL_STATUS),
            'photo_of_face'     => 'required',
            'photo_of_id'       => 'required',
            'residence_type'    => 'required|in:residence,non_residence',
        ];

        if($request->has('province') && $request->has('city')) {
            // User select the residence.
            $rules['city']     = 'required|exists:cities,code';
            $rules['province'] = 'required|exists:provinces,code';
        } else {
            $barangay = Barangay::find($request->barangay);
        }

        $this->validate($request, $rules, [
            'photo_of_face.required' => 'Please attach a photo of your face',
            'photo_of_id.required'   => 'Please attach a photo of your I.D'
        ]);
        
        // Upload user photo of face and photo of id.
        $photoOfFaceName = $request->file('photo_of_face')->getClientOriginalName();
        $request->file('photo_of_face')->storeAs('/public/images', $photoOfFaceName);

        $photoOfIdName = $request->file('photo_of_id')->getClientOriginalName();
        $request->file('photo_of_id')->storeAs('/public/photo_id', $photoOfIdName);


        DB::beginTransaction();
        try {

            $person = Person::find(Auth::user()->person_id);
            
            $person->temporary_address = $request->temporary_address;
            $person->address           = $request->address;
            $person->image             = $photoOfFaceName ?? $person->image;
            $person->photo_of_id       = $photoOfIdName;
            $person->gender            = $request->gender;
            $person->province_code     = $request->province ?? $barangay->province_code;
            $person->city_code         = $request->city ?? $barangay->city_code;
            $person->barangay_code     = $request->barangay;
            $person->civil_status      = $request->status;
            $person->email             = $request->email;
            $person->landline_number   = $request->landline_number;


            $account = $person->account;

            $account->save();
            $account->info()->save($person);

            DB::commit();

            return redirect()->route('home')->with('success', 'Successfully update your profile.');
        } catch(\Exception $e) {
            dd($e->getMessage());
            abort(404);
            DB::rollback();
        }


    }
}

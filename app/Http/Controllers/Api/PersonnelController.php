<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\PersonnelRepository;
use App\Barangay;
use App\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    public function __construct(PersonnelRepository $personnelRepository)
    {
        $this->personnelRepository = $personnelRepository;
    }


    public function login(Request $request)
    {
        
        if($request->has('phone_number')) {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'exists:people,phone_number',
            ]);

            if($validator->fails()) {
                return response()->json(['success' => false, 'message' => 'Please check your account credentials.']);
            }

            $person = Person::with('account')
                            ->where('phone_number', $request->phone_number)
                            ->first();

            if(Hash::check($request->mpin, $person->account->mpin)) {
                
                // These credentials are from User Model we need to set this two data into variable for removing the account information relation in Person model that automatically load
                // once we access some columns from it.
                $mpin     = $request->mpin;
                $username = $person->account->username;
                $province = $person->province->name;
                $city     = $person->city->name;
                $barangay = $person->barangay->name;

                // Removing the account information that load in person model
                $person = $person->setEagerLoads([])->first();

                // Setting two new key value pairs in person information.
                $person->username = $username;
                $person->mpin     = $mpin;
                $person->province = $province;
                $person->city     = $city;
                $person->barangay = $barangay;
                
                $person->makeHidden(['image', 'province_code', 'city_code', 'barangay_code', 'created_at', 'updated_at']);

                return response()->json(['success' => true, 'user' => $person]);
            } 

            return response()->json(['success' => false, 'message' => 'Please check your account credentials.']);
        } else {
            $validator = Validator::make($request->all(), [
                'username' => 'exists:users,username',
            ]);

            if($validator->fails()) {
                return response()->json(['success' => false, 'message' => 'Please check your account credentials.']);
            }

            $user = User::where('username', $request->username)
                            ->first();
            if(Hash::check($request->mpin, $user->mpin)) {
                // Push new key values in info these two values are seperated from the table columns.
                $province = $user->info->province->name;
                $city     = $user->info->city->name;
                $barangay = $user->info->barangay->name;

                $user = $user->setEagerLoads([])->first();

                $user->info->username = $user->username;
                $user->info->mpin     = $request->mpin;
                $user->info->province = $province;
                $user->info->city     = $city;
                $user->info->barangay = $barangay;
                
                $user->info->makeHidden(['image', 'province_code', 'city_code', 'barangay_code', 'created_at', 'updated_at']);
                return response()->json(['success' => true, 'user' => $user->info]);
            } 

            return response()->json(['success' => false, 'message' => 'Please check your account credentials.']);
        }

    }

    public function show(int $id) :Person
    {
        $columns = [
            'id','barangay_code', 'city_code', 'email', 'landline_number',
            'date_of_birth', 'age', 'civil_status','gender',
            'temporary_address', 'address'
        ];

        return Person::with(['city:code,name', 'barangay:code,name'])
                        ->find($id, $columns);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'unique:people,phone_number',
            'username' => 'unique:users,username',
            'email' => 'unique:people,email',
        ]);

        if($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $barangay = Barangay::find($request->barangay_code);

        $person = Person::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d'),
            'province_code' => $barangay->province_code,
            'city_code' => $barangay->city_code,
            'barangay_code' => $barangay->code,
            'gender' => $request->gender,
            'address' => $request->address,
            'age' => Carbon::now()->diffInYears(Carbon::parse($request->date_of_birth)),
            'civil_status' => $request->civil_status,
            'phone_number' => $request->phone_number,
            'landline_number' => $request->landline_number,
            'email' => $request->email,
        ]);

        $user = User::create([
            'username'  => $request->username,
            'password'  => bcrypt($request->password),
            'person_id' => $person->id,
        ]);

        return response()->json(['success' => true, 'message' => 'successfully register', 'person_id' => $person->person_id, 'age' => $person->age], 201);
    }


    public function make(Request $request)
    {
        $isExists = $this->personnelRepository->isUnique($request->all());

        if($isExists) {
            return response()->json(['code' => 422, 'message' => 'This user is already exists.']);
        }


        $personId = $this->personnelRepository->makeIDForMobile($request->all());

        return response()->json(
            [
                'code' => 200,
                'message' => 'Successfully generate id for person.',
                'person_id' => $personId,
            ]
        );
    }

}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Checker;
use Illuminate\Support\Facades\Hash;
use App\PersonLog;
use App\Http\Controllers\Repositories\CheckerRepository;
use Illuminate\Support\Facades\Validator;


class CheckerController extends Controller
{

    public function __construct(CheckerRepository $checkerRepository)
    {
        $this->checkerRepo = $checkerRepository;
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'exists:checkers,username',
            'password' => 'required',
        ], ['username.exists' => 'Check your username or password']);

        if($validator->fails()) {
            return response()->json(['code' => 422, 'message' => 'Please check your username or password.']);
        }

        if($this->checkerRepo->hasChecker($request->username)
            && Hash::check($request->password, $this->checkerRepo->getChecker()->password)) {

            // Access the current checker logged in with correct credentials.
            // By default when checker is legitimate this will automatically 
            // set the @setChecker in CheckerRepository.
            $checker = $this->checkerRepo->getChecker();

            // Generate temporary password.
            $generatedPassword = $this->checkerRepo
                            ->generatePassword($request->username, $request->password);

            return response()->json([
                'code'           => 200,
                'id'             => $checker->id,
                'username'       => $checker->username,
                'password'       => $generatedPassword,
                'firstname'      => $checker->firstname,
                'middlename'     => $checker->middlename,
                'lastname'       => $checker->lastname,
                'suffix'         => $checker->suffix,
                'phone_number'   => $checker->phone_number,
                'municipal_code' => $checker->municipal_code,
            ]);
        } else {
            return response()->json(['code' => 422, 'message' => 'Invalid username / password.']);
        }
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'       => 'required|unique:checkers,username',
            'password'       => 'required',
            'firstname'      => 'required',
            'middlename'     => 'required',
            'lastname'       => 'required',
            'municipal_code' => 'required|exists:cities,code',
            'phone_number'   => 'required|unique:checkers',
        ]);

        if($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }


        // Store new checker in storage.
        $checker = $this->checkerRepo->createAccount($request->all());

        // After successfully registered or login 
        // checker will often used this generated password for offline usage of ATP-Checker
        $password = $this->checkerRepo
                            ->generatePassword($request->username, $request->password);

        return response()->json([
            'id'             => $checker->id,
            'username'       => $checker->username,
            'password'       => $password,
            'firstname'      => $checker->firstname,
            'middlename'     => $checker->middlename,
            'lastname'       => $checker->lastname,
            'suffix'         => $checker->suffix,
            'phone_number'   => $checker->phone_number,
            'municipal_code' => $checker->municipal_code,
        ]);
    }


    public function countQRScanned(int $id)
    {
        $scanned = PersonLog::where('checker_id', $id)
                        ->count();
        return response()->json(['code' => 200, 'scanned_count' => $scanned]);
    }
}

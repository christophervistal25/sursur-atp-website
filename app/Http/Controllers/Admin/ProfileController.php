<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function edit()
	{
		$admin = Auth::user();
		return view('admin.auth.edit', compact('admin'));
	}

	public function updateAccount(Request $request, int $id)
	{
		$admin = Admin::find($id);
		$wantToChangePassword = false;

		// Default rules for the validation.
		$rules = [
			'username' => 'required|unique:admins,username,'. $id,
		];

		if (!is_null($request->password) || !is_null($request->password_confirmation)) {
			$rules['password'] = 'required|min:8|max:20|confirmed';
			$wantToChangePassword = true;
		}

		if($request->has('profile')) {
            $imageName = $request->file('profile')->getClientOriginalName();
            // Process of storing image.
            $request->file('profile')->storeAs('/public/images', $imageName);
        }

		$this->validate($request, $rules);
		$admin->username = $request->username;
		$admin->profile = $imageName ?? $admin->profile; 

         if ($wantToChangePassword) {
         	$admin->password = bcrypt($request->password);
         }

         $admin->save();
         return back()->with('success', 'Successfully update your profile.');
	}

	public function updateInfo(Request $request, int $id)
	{
		$admin = Admin::find($id);

		$this->validate($request, [
			'firstname'    => 'required',
			'middlename'   => 'required',
			'lastname'     => 'required',
			'phone_number' => 'required|unique:admins,phone_number,' . $id,
		]);

		$admin->firstname    = $request->firstname;
		$admin->middlename   = $request->middlename;
		$admin->lastname     = $request->lastname;
		$admin->suffix       = $request->suffix;
		$admin->phone_number = $request->phone_number;
        $admin->save();

        return back()->with('success', 'Successfully update your information.');
	}
}

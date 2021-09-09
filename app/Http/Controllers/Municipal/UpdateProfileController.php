<?php

namespace App\Http\Controllers\Municipal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateProfileController extends Controller
{
    public function edit()
    {
        $account = Auth::user();
        return view('municipal.auth.edit', compact('account'));
    }

    public function update(Request $request)
    {
        $account = Auth::user();

        $rules = [
            'username'     => 'required|unique:municipals,username,' . $account->id,
            'phone_number' => 'required|unique:municipals,phone_number,' . $account->id,
        ];


        if(!is_null($request->password)) {
            $rules['password'] = 'required|min:6|max:20|confirmed';
        }

        $this->validate($request, $rules);

        $account->username = $request->username;
        $account->phone_number = $request->phone_number;
        if(!is_null($request->password)) {
            $account->password = bcrypt($request->password);
        }
        $account->save();

        return back()->with('success', 'Successfully udpate your account.');

    }
}

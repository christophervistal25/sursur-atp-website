<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCredentialsController extends Controller
{
    public function edit()
    {
        $account = Auth::user();
        return view('user.credentials.update', compact('account'));
    }

    public function update(Request $request)
    {
        $account = Auth::user();

        $rules = [
            'username' => 'required|unique:users,username,' . $account->id,
        ];

        $this->validate($request, $rules);

        $account->username = $request->username;
        $account->password = !is_null($request->password) ? bcrypt($request->password) : $account->password;
        $account->save();

        return back()->with('success', 'Successfully update your account credentials.');

    }
}

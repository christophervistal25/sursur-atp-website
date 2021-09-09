<?php

namespace App\Http\Controllers\Auth;

use App\Municipal;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MunicipalLoginController extends Controller
{
    use AuthenticatesUsers;

	public function __construct()
	{
		  $this->middleware('guest:municipal')->except('logout');
	}

	public function login()
	{
		return view('municipal.auth.login');

	}

    public function loginMunicipal(Request $request)
    {

        // Attempt to log the user in
          if (Auth::guard('municipal')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('municipal.dashboard'));
          }
          // if unsuccessful, then redirect back to the login with the form data
          return redirect()->back()->withErrors(['message' => 'Please check your email / password.'])->withInput($request->only('username'));

    }

    public function logout()
    {
        Auth::guard('municipal')->logout();
        return redirect()->route('municipal.auth.login');
    }

    public function username()
    {
      return 'username';
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresidentLoginController extends Controller
{
      use AuthenticatesUsers;

	public function __construct()
	{
		$this->middleware('guest:president')->except('logout');
	}

	public function login()
	{
		return view('president.auth.login');
		
	}

    public function loginPresident(Request $request)
    {
    	 // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      // Attempt to log the user in
      if (Auth::guard('president')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('president.dashboard'));
      } 
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withErrors(['message' => 'Please check your email/password.'])->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::guard('president')->logout();
        return redirect()->route('president.auth.login');
    }
}

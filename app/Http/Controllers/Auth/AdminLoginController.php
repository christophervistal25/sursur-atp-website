<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    
    private const ERROR_MESSAGE = 'Please check your username / password.';
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
       public function __construct()
       {
           $this->middleware('guest:admin')->except('logout');
       }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginAdmin(Request $request)
    {
      // Validate the form data
      $validation = \Validator::make($request->all(), [
          'username'   => 'required',
          'password' => 'required'
      ]);
      
      $remember = $request->remember_me !== 'on' ? false : true;

        
      if($validation->fails()) {
          return $this->failedLogin();
      }

      if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
          return redirect()->intended(route('admin.dashboard'));
      } else {
          return $this->failedLogin();
      }

    }

    private function failedLogin()
    {
        return redirect()
        ->back()
        ->withErrors(['message' => self::ERROR_MESSAGE ])
        ->withInput(request()->only('username'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    }

 
}

<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Municipal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MunicipalAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Municipal::get();
        return view('admin.accounts.municipal.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::get();
        return view('admin.accounts.municipal.create', compact('cities'));
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
            'username'     => 'required|unique:municipals,username',
            'phone_number' => 'required|unique:municipals,phone_number|min:11|max:13',
            'password'     => 'required|confirmed|min:6|max:20',
            'city'         => ['required', 'exists:cities,code', function ($attribute, $value, $fail) {
                $municipal = Municipal::with('city')->where('city_code', $value)->first();
                
                if (!is_null($municipal)){
                    $fail('Account for ' . $municipal->city->name . ' municipal has already exists.');
                }
            } ], 
        ]);
        
        Municipal::create([
            'username'     => $request->username,
            'password'     => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'city_code'    => $request->city,
        ]);

        return back()->with('success', 'Successfully add new municipal account.');
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
    public function edit(Municipal $municipal_account)
    {
        $cities = City::get();
        return view('admin.accounts.municipal.edit', compact('municipal_account', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipal $municipal_account)
    {
        $this->validate($request, [
            'username'     => 'required|unique:municipals,username,' . $municipal_account->id,
            'phone_number' => 'required|min:11|max:13|unique:municipals,phone_number,' . $municipal_account->id,
            'city'         => 'required|exists:cities,code',
        ]);

        $municipal_account->username     = $request->username;
        $municipal_account->phone_number = $request->phone_number;
        
        if(!is_null($request->password)) {
            $municipal_account->password = bcrypt($request->password);
        }

        $municipal_account->save();

        return back()->with('success', 'Successfully update ' . $municipal_account->username . ' information.');

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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Checker;
use App\City;

class CheckerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkers = Checker::with('city')
                            ->get();
        return view('admin.checker.index', compact('checkers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::with('province:code,name')->get();
        return view('admin.checker.create', compact('cities'));
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
            'username'     => 'required|unique:checkers',
            'firstname'    => 'required',
            'middlename'   => 'required',
            'lastname'     => 'required',
            'city'         => 'required|exists:cities,code',
            'phone_number' => 'required|unique:checkers',
            'password'     => 'required|confirmed|min:6|max:20'
        ]);


        Checker::create([
            'username'       => $request->username,
            'firstname'      => $request->firstname,
            'middlename'     => $request->middlename,
            'lastname'       => $request->lastname,
            'suffix'         => $request->suffix,
            'municipal_code' => $request->city,
            'phone_number'   => $request->phone_number,
            'password'       => bcrypt($request->password),
        ]);

        return back()->with('success', 'Successfully create new checker account.');
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
    public function edit($id)
    {
        $cities = City::with('province:code,name')->get();
        $checker = Checker::find($id);
        return view('admin.checker.edit', compact('cities', 'checker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username'     => 'required|unique:checkers,username,' . $id,
            'firstname'    => 'required',
            'middlename'   => 'required',
            'lastname'     => 'required',
            'phone_number' => 'required|unique:checkers,phone_number,' . $id,
            'city'         => 'required|exists:cities,code',
        ]);

        $checker                 = Checker::find($id);
        $checker->username       = $request->username;
        $checker->firstname      = $request->firstname;
        $checker->middlename     = $request->middlename;
        $checker->lastname       = $request->lastname;
        $checker->suffix         = $request->suffix;
        $checker->phone_number   = $request->phone_number;
        $checker->municipal_code = $request->city;

        if(!is_null($request->password)) {
            $checker->password      = bcrypt($request->password);
        }

        $checker->save();

        return back()->with('success', 'Successfully update checker information.');

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

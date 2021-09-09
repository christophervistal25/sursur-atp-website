<?php

namespace App\Http\Controllers\Municipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Checker;
use Auth;

class CheckerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkers = Checker::where('municipal_code', Auth::user()->city_code)
                           ->get();

        return view('municipal.checker.index', compact('checkers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('municipal.checker.create');
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
            'phone_number' => 'required|unique:checkers',
            'password'     => 'required|confirmed|min:6|max:20'
        ]);


        Checker::create([
            'username'       => $request->username,
            'firstname'      => $request->firstname,
            'middlename'     => $request->middlename,
            'lastname'       => $request->lastname,
            'suffix'         => $request->suffix,
            'municipal_code' => Auth::user()->city_code,
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
    public function edit(Checker $m_checker)
    {
        $checker = $m_checker;
        return view('municipal.checker.edit', compact('checker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checker $m_checker)
    {


        $this->validate($request, [
            'username'     => 'required|unique:checkers,username,' . $m_checker->id,
            'firstname'    => 'required',
            'middlename'   => 'required',
            'lastname'     => 'required',
            'phone_number' => 'required|unique:checkers,phone_number,' . $m_checker->id,
        ]);

        $m_checker->username       = $request->username;
        $m_checker->firstname      = $request->firstname;
        $m_checker->middlename     = $request->middlename;
        $m_checker->lastname       = $request->lastname;
        $m_checker->suffix         = $request->suffix;
        $m_checker->phone_number   = $request->phone_number;
        $m_checker->municipal_code = Auth::user()->city_code;

        if(!is_null($request->password)) {
            $m_checker->password      = bcrypt($request->password);
        }

        $m_checker->save();

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

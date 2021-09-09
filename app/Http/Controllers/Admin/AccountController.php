<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::get();
        return view('admin.accounts.administrator.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.accounts.administrator.create');
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
            'username'     => 'required|unique:admins,username',
            'phone_number' => 'required|unique:admins,phone_number|min:11|max:13',
            'firstname'    => 'required',
            'middlename'   => 'required',
            'lastname'     => 'required',
            'password'     => 'required|confirmed|min:6|max:20',
            'suffix'       => 'sometimes|max:3',
            'image'        => 'sometimes|required',
        ]);

        if($request->has('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            // Process of storing image.
            $request->file('image')->storeAs('/public/images', $imageName);
        }


        Admin::create([
            'username'     => $request->username,
            'firstname'    => $request->firstname,
            'middlename'   => $request->middlename,
            'lastname'     => $request->lastname,
            'suffix'       => $request->suffix,
            'password'     => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'profile'      => $imageName ?? 'no_image.png',
        ]);

        return back()->with('success', 'Successfully add new administrator.');
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
    public function edit(Admin $admin)
    {
        return view('admin.accounts.administrator.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $this->validate($request, [
            'username'     => 'required|unique:admins,username,' . $admin->id,
            'phone_number' => 'required|min:11|max:13|unique:admins,phone_number,' . $admin->id,
            'firstname'    => 'required',
            'middlename'   => 'required',
            'lastname'     => 'required',
            'password'     => 'sometimes|nullable|confirmed|min:6|max:20',
            'suffix'       => 'sometimes|max:3',
            'image'        => 'sometimes|required',
        ]);

        if($request->has('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            // Process of storing image.
            $request->file('image')->storeAs('/public/images', $imageName);
        }

        $admin->username     = $request->username;
        $admin->phone_number = $request->phone_number;
        $admin->firstname    = $request->firstname;
        $admin->middlename   = $request->middlename;
        $admin->lastname     = $request->lastname;
        $admin->suffix        = $request->suffix;
        $admin->profile      = $imageName ?? $admin->profile;
        
        if(!is_null($request->password)) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return back()->with('success', 'Successfully update ' . $admin->lastname . ' information.');

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

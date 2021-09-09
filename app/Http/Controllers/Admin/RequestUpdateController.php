<?php

namespace App\Http\Controllers\Admin;

use App\Province;
use App\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\PersonnelRepository;
use App\Person;

class RequestUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = UpdateUserRequest::with('person:person_id,id,firstname,middlename,lastname,suffix')->where('status', 'pending')
                                    ->get();
        return view('admin.request.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = UpdateUserRequest::find($id);

        if($request->status !== 'pending') {
            abort(404);
        }
        
        $provinces =  Province::get(['code', 'name']);
        $civil_status = PersonnelRepository::CIVIL_STATUS;
        $person = Person::find($request->person_id);
        $request->fields = json_decode($request->fields);
        return view('admin.request.show', compact('request', 'person', 'provinces', 'civil_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $r = UpdateUserRequest::find($id);
        $person = Person::with('account')->find($r->person_id);


        if($request->status !== 'reject') {
            $request = UpdateUserRequest::find($id);

            foreach(json_decode($request->fields) as $field => $value) {
                if($field === 'password') {
                    $person->account->update([
                        'password' => bcrypt($value)
                    ]);
                } else if($field === 'mpin') {
                    $person->account->update([
                        'password' => bcrypt($value)
                    ]);
                } else {
                    $person->$field  = $value;
                }
            }
            $request->status = 'accept';
            $request->save();
            $person->save();
        
        } else {
            $request = UpdateUserRequest::find($id);
           
            $request->status = 'reject';
            $request->save();    
        }

        return  redirect()->route('request.index');
        
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

<?php

namespace App\Http\Controllers\Municipal;

use App\Campus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\City;
use App\PersonLog;
use App\Admin;
use App\Municipal;
use App\Person;
use App\Barangay;
use Auth;
use App\Checker;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:municipal',['only' => 'index','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangays = [];
        $barangaysValue = [];
        $checkers = Checker::where(['municipal_code' => Auth::user()->city_code])->count();

        $barangays      = implode(',', $barangays);
        $barangaysValue = implode(',', $barangaysValue);

        $normal = PersonLog::has('person')->with(['person' => function ($query) {
            $query->where('city_code', Auth::user()->city_zip_code);
        }])->where('body_temperature', '<=', 37)->count();

        $notNormal = PersonLog::has('person')->with(['person' => function ($query) {
            $query->where('city_code', Auth::user()->city_zip_code);
        }])->where('body_temperature', '>', 38)->count();


        // No of Registered Municipal Account
        $noOfBarangays = Barangay::where('city_code', Auth::user()->city_zip_code)->count();

        // No of People Registered
        $peoples = Person::where('city_code', Auth::user()->city_code)->count();


        return view('municipal.dashboard', compact('barangays', 'barangaysValue', 'normal', 'notNormal', 'noOfBarangays', 'peoples', 'checkers'));
    }

}

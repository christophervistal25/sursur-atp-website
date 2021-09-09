<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\City;
use App\PersonLog;
use App\Municipal;
use App\Admin;
use App\Person;
use App\Checker;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin',['only' => 'index','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        return view('admin.dashboard');
        // return view('admin.dashboard', compact('peoples', 'checkers', 'admins', 'municipals_account', 'noOfCities'));
    }

}

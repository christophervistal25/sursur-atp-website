<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class QRController extends Controller
{
    public function index()
    {
        $person = Auth::user()->info;
        return view('user.person-id', compact('person'));
    }
}

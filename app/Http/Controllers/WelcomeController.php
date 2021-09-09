<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        return redirect()->route('login');
    }
}

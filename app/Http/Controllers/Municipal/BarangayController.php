<?php

namespace App\Http\Controllers\Municipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Barangay;

class BarangayController extends Controller
{
    public function list()
    {
        return Laratables::recordsOf(Barangay::class);
    }

    public function index()
    {
        return view('municipal.barangay.index');
    }
}

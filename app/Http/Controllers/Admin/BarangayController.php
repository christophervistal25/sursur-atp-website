<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Barangay;
use Freshbitsweb\Laratables\Laratables;

class BarangayController extends Controller
{

    public function list()
    {
        return Laratables::recordsOf(Barangay::class, function ($query) {
            return $query->orderBy('name');
        });
    }

    public function index()
    {
        return view('admin.barangay.index');
    }
}

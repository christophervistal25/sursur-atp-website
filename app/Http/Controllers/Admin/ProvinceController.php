<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use Freshbitsweb\Laratables\Laratables;

class ProvinceController extends Controller
{
    public function list()
    {
        return Laratables::recordsOf(Province::class, function ($query) {
            return $query->with(['cities', 'barangay'])->orderBy('name');
        });
    }

    public function index()
    {
        return view('admin.province.index');
    }
}

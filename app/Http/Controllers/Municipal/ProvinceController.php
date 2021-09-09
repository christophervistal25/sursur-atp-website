<?php

namespace App\Http\Controllers\Municipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Province;


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
        return view('municipal.province.index');
    }
}

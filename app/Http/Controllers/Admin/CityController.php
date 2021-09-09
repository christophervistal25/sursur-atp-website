<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use Freshbitsweb\Laratables\Laratables;


class CityController extends Controller
{

    public function list()
    {
        return Laratables::recordsOf(City::class, function ($query) {
            return $query->with(['province:code,name', 'barangays'])->orderBy('name');
        });
    }

    public function index()
    {
        return view('admin.city.index');
    }
}

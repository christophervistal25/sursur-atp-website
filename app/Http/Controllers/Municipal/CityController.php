<?php

namespace App\Http\Controllers\Municipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return view('municipal.city.index');
    }
}

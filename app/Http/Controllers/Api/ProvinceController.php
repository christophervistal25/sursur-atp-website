<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use App\Barangay;
use App\Province;

class ProvinceController extends Controller
{
    public const SECONDS_IN_ONE_DAY = 86400;

    public function province()
    {
        return Province::get(['code', 'name']);
    }

    public function municipals(string $province_code = null)
    {
        $municipals = City::where('province_code', $province_code)
                    ->get(['code', 'name']);

        return response()->json(['municipals' => $municipals]);
    }

    public function barangays(string $city_code = null)
    {
        $barangays = Barangay::where('city_code', $city_code)
                ->get(['code', 'name']);

        return response()->json(['barangays' => $barangays]);
    }
}

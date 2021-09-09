<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Barangay;

class BarangayController extends Controller
{
    public function barangay()
    {
        Cache::flush();
        return Barangay::get(['code', 'name']);
    }
}

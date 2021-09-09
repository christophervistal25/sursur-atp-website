<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\QuickStat;
class SurigaoStatController extends Controller
{
    public function data()
    {
        $stat =  QuickStat::get();
        
        return response()->json([
            'confirmed' => $stat->sum('confirmed'),
            'recovered' => $stat->sum('recovered'),
            'deaths'    => $stat->sum('deaths'),
        ]);
        
    }
}

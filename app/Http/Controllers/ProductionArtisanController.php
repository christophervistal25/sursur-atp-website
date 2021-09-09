<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionArtisanController extends Controller
{
    public function clear()
    {
        \Artisan::call('cache:clear');
	    \Artisan::call('config:clear');
	    \Artisan::call('route:clear');
	    \Artisan::call('view:clear');
        return "Clear all cache";
    }

    public function cache()
    {
        \Artisan::call('config:cache');
	    \Artisan::call('route:cache');
	    \Artisan::call('view:cache');
        return "Successfully cache all";
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache, View;

class SiteController extends Controller
{
    public function welcome()
    {
    	$res = Cache::remember('pxorg:page:welcome', now()->addHours(12), function() {
    		return View::make('welcome')->render();
    	});

    	return $res;
    }
}

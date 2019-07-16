<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache, View;

class SiteController extends Controller
{
	public function welcome()
	{
		$res = Cache::remember('pxorg:page:welcome', now()->addMonths(1), function() {
			return View::make('welcome')->render();
		});

		return $res;
	}

	public function join()
	{
		$res = Cache::remember('pxorg:page:join', now()->addMonths(1), function() {
			return View::make('join.home')->render();
		});

		return $res;
	}
}

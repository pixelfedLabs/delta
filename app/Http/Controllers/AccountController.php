<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instance;

class AccountController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function home(Request $request)
	{
		$uid = $request->user()->id;
		$instances = Instance::whereUserId($uid)->paginate(10);
		return view('account.dashboard', compact('instances'));
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstanceController extends Controller
{
    public function index(Request $request)
    {
    	return view('instance.index');
    }

    public function add(Request $request)
    {
    	return view('instance.add');
    }

}

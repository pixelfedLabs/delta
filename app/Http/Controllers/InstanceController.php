<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instance;

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

    public function show(Request $request, $domain)
    {
    	$instance = Instance::whereDomain($domain)
    		->whereNotNull('approved_at')
    		->firstOrFail();

    	return view('instance.show', compact('instance'));
    }

}

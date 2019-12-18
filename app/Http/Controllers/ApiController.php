<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instance;

class ApiController extends Controller
{
	public function instances(Request $request)
	{
		$this->validate($request, [
			'page' => 'nullable|integer|min:1',
			'latestVersionOnly' => 'nullable',
			'allowsVideos' => 'nullable',
			'openRegistration' => 'nullable',
		]);

		$i = Instance::query();

		$i->whereNotNull('approved_at');

		if($request->openRegistration == 'true') {
			$i->where('nodeinfo->openRegistrations', true);
		}

		if($request->latestVersionOnly == 'true') {
			$i->where('nodeinfo->software->version', '0.10.6');
		}

		if($request->allowsVideos == 'true') {
			$i->whereJsonContains('nodeinfo->metadata->config->uploader', 'video/mp4');
		}
		
		return $i->paginate(10);
	}
}

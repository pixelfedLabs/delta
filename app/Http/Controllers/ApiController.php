<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use \Zttp\Zttp;
use App\Instance;
use Illuminate\Support\Str;

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
		
		return $i->inRandomOrder()->paginate(10);
	}

	public function instance(Request $request, $domain)
	{
		$instance = Instance::whereNotNull('approved_at')
			->whereDomain($domain)
			->firstOrFail();
		return $instance;
	}

	public function instanceTimeline(Request $request, $domain)
	{
		$instance = Instance::whereNotNull('approved_at')
			->whereDomain($domain)
			->firstOrFail();

		$res = Cache::remember('instance:timeline:'.$instance->id, now()->addHours(12), function() use($domain){
			$url = "https://{$domain}/api/v1/timelines/public?limit=20";
			$timeline = Zttp::get($url);
			$body = collect($timeline->json())
			->filter(function($v, $k) {
				return $v['sensitive'] == false && !empty($v['media_attachments']);
			})->map(function($p, $k) {
				$thumb = 'https://px03-camo.pixelfedcdn.com/img-proxy?resource=' . encrypt($p['media_attachments'][0]['preview_url']);
				return [
					'id' => $p['id'],
					'url' => $p['url'],
					'thumbnail' => $thumb
				];
			});
			return $body->all();
		});

		return $res;
	}

	public function imageProxy(Request $request)
	{
		$resource = decrypt($request->input('resource'));

		if(!$resource || !Str::startsWith($resource, 'https://') || !Str::endsWith($resource, ['.jpg', '.png', '.jpeg'])) {
			abort(404, 'Invalid resource');
		}
		$mime = Str::endsWith($resource, '.png') ? 'image/png' : 'image/jpeg';
		$hash = hash('sha512', $resource);

		$res = Cache::remember('proxy:img:hash:' . $hash, now()->addMinutes(30), function() use($resource) {

			$options  = ['http' => [
				'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36'
				]
			];
			$context  = stream_context_create($options);
			return file_get_contents($resource, false, $context);
		});

		return response($res)->header('Content-Type', $mime);
	}
}

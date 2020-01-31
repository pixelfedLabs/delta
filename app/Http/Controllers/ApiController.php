<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use \Zttp\Zttp;
use App\Instance;
use Illuminate\Support\Str;
use App\Services\PixelfedVersions;

class ApiController extends Controller
{
	public function instances(Request $request)
	{
		$this->validate($request, [
			'page' => 'nullable|integer|min:1',
			'latestVersionOnly' => 'nullable',
			'allowsVideos' => 'nullable',
			'openRegistration' => 'nullable',
			'albumSizeRange' => 'required|integer|min:0|max:20',
			'fileSizeLimit'  => 'integer|min:1|max:100'
		]);

		$albumLimit = (int) $request->input('albumSizeRange');

		$i = Instance::query();

		$i->whereNotNull('approved_at')
		->where('nodeinfo->metadata->config->uploader->album_limit', '>=', $albumLimit);

		if($request->openRegistration == 'true') {
			$i->where('nodeinfo->openRegistrations', true);
		}

		if($request->latestVersionOnly == 'true') {
			$i->where('nodeinfo->software->version', PixelfedVersions::latest());
		}

		if($request->allowsVideos == 'true') {
			$i->where('nodeinfo->metadata->config->uploader->media_types', 'like', '%mp4%');
		}

		if($request->input('fileSizeLimit') !== 15) {
			$sizeLimit = $request->input('fileSizeLimit') * 1000;
			$i->where('nodeinfo->metadata->config->uploader->max_photo_size', '>=', $sizeLimit);
		}

		return $i->paginate(20);
	}

	public function instance(Request $request, $domain)
	{
		$instance = Instance::whereNotNull('approved_at')
			->whereDomain($domain)
			->whereIn('nodeinfo->software->version', PixelfedVersions::get())
			->firstOrFail();
			
		return $instance;
	}

	public function instanceTimeline(Request $request, $domain)
	{
		$this->validate($request, [
			'limit' => 'nullable|integer|min:1|max:20'
		]);

		$instance = Instance::whereNotNull('approved_at')
			->whereDomain($domain)
			->firstOrFail();

		$key = 'delta:instance:timeline:' . $instance->id;
		$ttl = now()->addDays(12);

		$res = Cache::remember($key, $ttl, function () use ($domain) {
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
			return $body->toArray();
		});

		if($request->input('limit')) {
			$res = array_slice($res, 0, (int) $request->limit);
		}

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

		$key = 'delta:proxy:img:hash:' . $hash;
		$ttl = now()->addHours(6);

		$res = Cache::remember($key, $ttl, function () use ($resource) {
			$options  = [
				'http' => [
					'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36'
				]
			];
			$context  = stream_context_create($options);
			return file_get_contents($resource, false, $context);
		});

		return response($res)->header('Content-Type', $mime);
	}

	public function stats(Request $request)
	{
		return Cache::remember('instances:stats', now()->addHours(12), function() {
			return [
				'post_count' => Instance::sum('post_count'),
				'user_count' => Instance::sum('user_count'),
				'instance_count' => Instance::whereNotNull('approved_at')->count(),
			];
		});
	}
}

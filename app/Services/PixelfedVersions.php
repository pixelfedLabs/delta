<?php 

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use \Zttp\Zttp;

class PixelfedVersions
{
	public const VERSIONS = [
		'0.10.5',
		'0.10.6',
		'0.10.7',
		'0.10.8',
		'0.10.9'
	];

	public static function get()
	{
		return Cache::rememberForever('px:join:software_versions', function() {
			try {
				$res = Zttp::timeout(30)
					->get('https://api.github.com/repos/pixelfed/pixelfed/releases');
            } catch (\Zttp\ConnectionException $e) {
                return self::VERSIONS;
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                return self::VERSIONS;
            }

            $json = collect($res->json());
            $res = $json->map(function($v) {
            	return Str::startsWith($v['tag_name'], 'v') ? substr($v['tag_name'], 1) : $v['tag_name'];
            })->toArray();
            ksort($res);
            return $res;
		});
	}

	public static function latest()
	{
		return last(self::VERSIONS);
	}
}
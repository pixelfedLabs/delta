<?php 

namespace App\Services;

class PixelfedVersions
{
	public const VERSIONS = [
		'0.10.5',
		'0.10.6',
		'0.10.7',
		'0.10.8'
	];

	public static function get()
	{
		return self::VERSIONS;
	}

	public static function latest()
	{
		return last(self::VERSIONS);
	}
}
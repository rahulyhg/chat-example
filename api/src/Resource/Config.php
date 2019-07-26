<?php

namespace App\Resource;

class Config {

	public static function isProd() {
		return false;
	}

	public static function dbConnection() {
		return self::isProd() ? [

		] : [
			'driver' => 'mysqli',
			'host' => 'database',
			'database' => 'solarWindsChat',
			'username' => 'root',
			'password' => 'solarWindsChat'
		];
	}

}
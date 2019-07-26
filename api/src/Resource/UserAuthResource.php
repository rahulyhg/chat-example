<?php
namespace App\Resource;

use \App\Entity\UserEntity;
use \Firebase\JWT\JWT;
use \App\Service\LoginService;

class UserAuthResource {
	
	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance =  new self();
		}
		return self::$instance;
	}

	public function getAuthToken(UserEntity $userEntity) {
		return JWT::encode([ 'id' => $userEntity->getId(), 'role' => 'owner' ], LoginService::JWT_KEY);
	}

}
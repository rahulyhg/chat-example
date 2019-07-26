<?php

namespace App\Service;

use \App\Entity\UserEntity;
use \App\Resource\UserAuthResource;

class UserAuthService extends BaseService {

	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance =  new self();
		}
		return self::$instance;
	}

	public function __construct() {
		$this->userService = UserService::create();
		$this->messageService = MessageService::create();
		$this->userAuthResource = UserAuthResource::create();
	}

	public function getAuthToken(UserEntity $userEntity) {
		return $this->userAuthResource->getAuthToken($userEntity);
	}

	public function postLogin($username, $password) {
		$userRow = $this->userService->getUser(['username' => $username ]);
		if (!$userRow) {
			return false;
		}
		$userEntity = $this->userService->newEntity($userRow);
		if (!password_verify($password, $userEntity->password())) {
			return null;
		}
		return [
			'authToken' => $this->getAuthToken($userEntity),
			'user' => [
				'id' => $userEntity->getId(), 
				'nickname' => $userEntity->nickname(),
				'email' => $userEntity->email()
			],
			'messages' => $this->messageService->getAllMessage(),
			'users' => $this->userService->getAllUser(),
		];
	}

}
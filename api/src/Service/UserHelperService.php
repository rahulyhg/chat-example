<?php // Julie specific file
namespace App\Service;

use App\Entity\UserEntity;
use App\Resource\DbResource;

class UserHelperService extends BaseService {

	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		$this->userService = UserService::create();
	}


	public function postUser($email, $username, $nickname, $password, $retype) {
		if ($password !== $retype) {
			return null;
		}
		$existUserEntity = $this->userService->getUser(['username' => $username]);
		if ($existUserEntity) {
			return null;
		}
		$password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
		$userEntity = $this->userService->newEntity([
			'email' => $email,
			'username' => $username,
			'nickname' => $nickname,
			'password' => $password
		]);
		return $this->userService->postUser($userEntity, []);
	}


}
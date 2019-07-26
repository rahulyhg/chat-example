<?php // Julie automatic generated file
namespace App\Service;

use App\Entity\UserEntity;
use App\Resource\DbResource;

class UserService extends BaseService {

	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function newEntity($attributes) {
		return new UserEntity((array) $attributes);
	}

	public function getAllUser($attrs = []) {
		if (!$attrs) {
			$attrs = [];
		}
		return $this->db->select('*')->from('user')->where($attrs)->fetchAssoc('id');
	}

	public function getUser(array $attrs = []) {
		return $this->db->select('*')->from('user')->where($attrs)->fetch();
	}

	public function postUser(UserEntity $userEntity, array $user) {
		if (array_key_exists('id', $user)) {
			$userEntity->user_id($user['id']);
		}
		$this->db->insert('user', $userEntity->assign())->execute();
		return $this->db->getInsertId();
	}

	public function putUser(UserEntity $userEntity, array $user) {
		$query = $this->db->update('user', $userEntity->assign())->where(['id' => $userEntity->getId()]);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

	public function deleteUser(UserEntity $userEntity, array $user) {
		$query = $this->db->delete('user')->where(['id' => $userEntity->getId()]);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

	public function deleteUserBy(array $attrs, array $user) {
		$query = $this->db->delete('user')->where($attrs);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

}
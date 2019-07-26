<?php // Julie automatic generated file
namespace App\Service;

use App\Entity\GroupEntity;
use App\Resource\DbResource;

class GroupService extends BaseService {

	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function newEntity($attributes) {
		return new GroupEntity((array) $attributes);
	}

	public function getAllGroup($attrs = []) {
		if (!$attrs) {
			$attrs = [];
		}
		return $this->db->select('*')->from('group')->where($attrs)->fetchAssoc('id');
	}

	public function getGroup(array $attrs = []) {
		return $this->db->select('*')->from('group')->where($attrs)->fetch();
	}

	public function postGroup(GroupEntity $groupEntity, array $user) {
		if (array_key_exists('id', $user)) {
			$groupEntity->user_id($user['id']);
		}
		$this->db->insert('group', $groupEntity->assign())->execute();
		return $this->db->getInsertId();
	}

	public function putGroup(GroupEntity $groupEntity, array $user) {
		$query = $this->db->update('group', $groupEntity->assign())->where(['id' => $groupEntity->getId()]);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

	public function deleteGroup(GroupEntity $groupEntity, array $user) {
		$query = $this->db->delete('group')->where(['id' => $groupEntity->getId()]);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

	public function deleteGroupBy(array $attrs, array $user) {
		$query = $this->db->delete('group')->where($attrs);
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
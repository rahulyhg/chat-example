<?php // Julie automatic generated file
namespace App\Service;

use App\Entity\Group_memberEntity;
use App\Resource\DbResource;

class Group_memberService extends BaseService {

	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function newEntity($attributes) {
		return new Group_memberEntity((array) $attributes);
	}

	public function getAllGroup_member($attrs = []) {
		if (!$attrs) {
			$attrs = [];
		}
		return $this->db->select('*')->from('group_member')->where($attrs)->fetchAssoc('id');
	}

	public function getGroup_member(array $attrs = []) {
		return $this->db->select('*')->from('group_member')->where($attrs)->fetch();
	}

	public function postGroup_member(Group_memberEntity $group_memberEntity, array $user) {
		if (array_key_exists('id', $user)) {
			$group_memberEntity->user_id($user['id']);
		}
		$this->db->insert('group_member', $group_memberEntity->assign())->execute();
		return $this->db->getInsertId();
	}

	public function putGroup_member(Group_memberEntity $group_memberEntity, array $user) {
		$query = $this->db->update('group_member', $group_memberEntity->assign())->where(['id' => $group_memberEntity->getId()]);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

	public function deleteGroup_member(Group_memberEntity $group_memberEntity, array $user) {
		$query = $this->db->delete('group_member')->where(['id' => $group_memberEntity->getId()]);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

	public function deleteGroup_memberBy(array $attrs, array $user) {
		$query = $this->db->delete('group_member')->where($attrs);
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
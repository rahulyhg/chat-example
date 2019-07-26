<?php // Julie automatic generated file
namespace App\Service;

use App\Entity\MessageEntity;
use App\Resource\DbResource;

class MessageService extends BaseService {

	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function newEntity($attributes) {
		return new MessageEntity((array) $attributes);
	}

	public function getAllMessage($attrs = []) {
		if (!$attrs) {
			$attrs = [];
		}
		return $this->db->select('*')->from('message')->where($attrs)->fetchAssoc('id');
	}

	public function getMessage(array $attrs = []) {
		return $this->db->select('*')->from('message')->where($attrs)->fetch();
	}

	public function postMessage(MessageEntity $messageEntity, array $user) {
		if (array_key_exists('id', $user)) {
			$messageEntity->user_id($user['id']);
		}
		$this->db->insert('message', $messageEntity->assign())->execute();
		return $this->db->getInsertId();
	}

	public function putMessage(MessageEntity $messageEntity, array $user) {
		$query = $this->db->update('message', $messageEntity->assign())->where(['id' => $messageEntity->getId()]);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

	public function deleteMessage(MessageEntity $messageEntity, array $user) {
		$query = $this->db->delete('message')->where(['id' => $messageEntity->getId()]);
		switch ($user['role']) {
			case 'owner':
				$query = $query->where('user_id = %i', $user['id']);
				break;

			case 'manager':
				break;
		}
		$query->execute();
	}

	public function deleteMessageBy(array $attrs, array $user) {
		$query = $this->db->delete('message')->where($attrs);
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
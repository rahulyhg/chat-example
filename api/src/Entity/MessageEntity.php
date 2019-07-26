<?php // Julie automatic generated file
namespace App\Entity;


class MessageEntity extends BaseEntity {

	const table = "message";

	public function __construct($attributes) {
		$this->hydrate([
			
			

		]);
		parent::__construct($attributes);
	}

	public function user_id($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_id, false);
	}

	public function created($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_datetime, false);
	}

	public function content($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_text, false);
	}

	public function show_user_id($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_id, false);
	}

	public function group_id($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_id, false);
	}

}
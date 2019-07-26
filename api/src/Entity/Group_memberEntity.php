<?php // Julie automatic generated file
namespace App\Entity;


class Group_memberEntity extends BaseEntity {

	const table = "group_member";

	public function __construct($attributes) {
		$this->hydrate([

		]);
		parent::__construct($attributes);
	}

	public function user_id($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_id, false);
	}

	public function group_id($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_id, false);
	}

}
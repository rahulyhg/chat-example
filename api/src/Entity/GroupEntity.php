<?php // Julie automatic generated file
namespace App\Entity;


class GroupEntity extends BaseEntity {

	const table = "group";

	public function __construct($attributes) {
		$this->hydrate([
			

		]);
		parent::__construct($attributes);
	}

	public function title($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_string, false);
	}

}
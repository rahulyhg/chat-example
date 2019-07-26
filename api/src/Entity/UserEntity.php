<?php // Julie automatic generated file
namespace App\Entity;


class UserEntity extends BaseEntity {

	const table = "user";

	public function __construct($attributes) {
		$this->hydrate([
			
			
			
			

		]);
		parent::__construct($attributes);
	}

	public function email($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_string, false);
	}

	public function nickname($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_string, false);
	}

	public function username($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_string, false);
	}

	public function password($value = false) {
		return $this->getOrSet(__FUNCTION__, $value, self::type_string, false);
	}

}
<?php
namespace App\Entity;

abstract class BaseEntity {

	const type_string = 'string';
	const type_text = 'string';
	const type_int = 'int';
	const type_id = 'id';
	const type_float = 'float';
	const type_bool = 'bool';
	const type_date = 'date';
	const type_datetime = 'datetime';

	private $_attributes = [];
	protected $optionalAttributes = [ 'user_id' ];
	
	public function __construct(array $attrs = []) {
		$this->hydrate($attrs);
	}

	protected function hydrate(array $attrs) {
		foreach ($attrs as $key => $value) {
			if ($key === 'id') {
				$this->_attributes['id'] = $value;
			} else {
				if (method_exists($this, $key)) {
					$this->{$key}($value);
				} elseif (!in_array($key, $this->optionalAttributes)) {
					throw new \Exception($key . ' is not defined');
				}
			}
		}		
	}

	public function assign() {
		return $this->_attributes;
	}

	public function getId() {
		return $this->_attributes['id'];
	}

	protected function getOrSet($attribute, $value, $type, $getterValue) {
		if ($value === $getterValue) {
			return $this->{'get_' . $type}($this->_attributes[$attribute]);
		} else {
			$this->_attributes[$attribute] = $this->{'set_' . $type}($value);
			return $this;
		}
	}

	private function set_string($value) {
		return $value;
	}

	private function get_string($value) {
		return $value;
	}

	private function set_id($value) {
		$id = intval($value);
		if ($id) {
			return $id;
		} else {
			$this->_errors[] = $value . ' is not ID';
			return null;
		}
	}

	private function get_id($value) {
		return $value;
	}

	private function set_int($value) {
		return intval($value);
	}

	private function get_int($value) {
		return $value;
	}

	private function set_float($value) {
		return floatval($value);
	}

	private function get_float($value) {
		return $value;
	}

	private function set_date($value) {
		if (is_array($value)) {
			return strtotime($value['date']);
		}
		return date('Y-m-d', strtotime($value));
	}

	private function get_date($value) {
		return (string) $value;
	}

	private function set_datetime($value) {
		if (is_array($value)) {
			return strtotime($value['date']);
		}
		return date('Y-m-d H:i:s', strtotime($value));
	}

	private function get_datetime($value) {
		return (string) $value;
	}

}
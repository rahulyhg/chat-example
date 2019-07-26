<?php
namespace App\Resource;

use \Dibi\Connection;

class DbResource {

	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance =  new self();
		}
		return self::$instance;
	}	

	public function __construct() {
		$this->db = new Connection(Config::dbConnection());
	}

	public function find($entityClass, $id) {
		eval('$table = ' . $entityClass . '::table;');
		$row = $this->db->select('*')->from($table)->where("id = %u", $id)->fetchAll();
		if ($row) {
			return new $entityClass((array) $row);
		}
		return null;
	}

	public function findAllBy($entityClass, $params) {
		eval('$table = ' . $entityClass . '::table;');
		$listRow = $this->db->select('*')->from($table)->where($params)->fetchAll();
		if ($listRow) {
			$result = [];
			foreach ($listRow as $row) {
				$result[$row->id] = new $entityClass((array) $row);
			}
		}
		return null;
	}

	public function findBy($entityClass, $params) {
		eval('$table = ' . $entityClass . '::table;');
		$row = $this->db->select('*')->from($table)->where($params)->fetch();
		if ($row) {
			return new $entityClass((array) $row);
		}
	}

	public function insert($entityClass, IPersistableEntity $entity) {
		eval('$table = ' . $table);
		if ($entity->isValid()) {
			$this->db->insert($table, $entity->assign());
			return $this->db->insertId();
		} else {
			return $entity->getErrors();
		}
	}

	public function update($entityClass, IPersistableEntity $entity) {
		eval('$table = ' . $entityClass . '::table;');
		if ($entity->isValid()) {
			$this->db->update($table, $entity)->where("id = %u", $entity->getId());
			return null;
		} else {
			return $entity->getErrors();
		}
	}

	public function delete($entityClass, IPersistableEntity $entity) {
		eval('$table = ' . $entityClass . '::table;');
		if ($entity->isValid()) {
			$this->db->delete($table)->where("id = %u", $entity->getId());
			return null;
		} else {
			return $entity->getErrors();
		}
	}

}
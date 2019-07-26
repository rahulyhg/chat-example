<?php
namespace App\Service;

use App\Resource\Config;
use Dibi\Connection;

class BaseService {

	public static $dbInstance = null;
	protected $db = null;

	public function __construct() {
		if (!self::$dbInstance) {
			self::$dbInstance = new Connection(Config::dbConnection());
		}
		$this->db = self::$dbInstance;
	}

	public function collectAndAssign(array $data) {
		foreach ($data as &$item) {
			$entity = $this->newEntity((array) $item);
			$item = $entity->assign();
		}
		return $data;
	}

	public function transaction() {
		$this->db->begin();
	}

	public function commit() {
		$this->db->commit();
	}

	public function rolback() {
		$this->db->rollback();
	}

}
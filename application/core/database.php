<?php

namespace TDL\Core;

class Database {

	public $db;

	public function __construct() {
		$this->db = @mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);
		if (mysqli_connect_errno()) {
			die('Failed to connect to MySQL: '.mysqli_connect_error());
		}
	}

	public function __destruct() {
		if (!mysqli_connect_errno()) {
			$this->db->close();
		}
	}
}

?>
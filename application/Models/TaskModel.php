<?php

namespace TDL\Models;

use TDL\Core\Database;

class taskModel extends Database {
	public function __construct() {
		// Create a database connection.
		parent::__construct();
	}

	public function view() {
		$sql 	= 'SELECT * FROM tasks;';
		$tasks  = $this->db->query($sql);

		$html = '';
		ob_start();	
		require APP.'/Views/headerView.php';
		require APP.'/Views/taskView.php';
		require APP.'/Views/footerView.php';
		$html = ob_get_clean();
		return $html;
	}

	public function add(string $name, string $description, string $date, string $forUser):string {
		$name 		 = $this->db->real_escape_string($name);
		$description = $this->db->real_escape_string($description);
		$date 		 = $this->db->real_escape_string($date);
		$forUser 	 = $this->db->real_escape_string($forUser);

		$sql = 'INSERT INTO tasks (task_name, task_description, task_date, task_user)
				VALUES ("'.$name.'", "'.$description.'", "'.$date.'", "'.$forUser.'");';
		if ($this->db->query($sql) === true) {
			return 'success';
		} else {
			return 'Error: '.$this->db->error;
		}
	}

	public function edit(int $id, string $name, string $description, string $date, string $forUser):string {
		$id 		 = (int)$this->db->real_escape_string($id);
		$name 		 = $this->db->real_escape_string($name);
		$description = $this->db->real_escape_string($description);
		$date 		 = $this->db->real_escape_string($date);
		$forUser 	 = $this->db->real_escape_string($forUser);

		$sql = 'UPDATE tasks SET task_name 			= "'.$name.'",
								 task_description	= "'.$description.'",
								 task_date			= "'.$date.'",
								 task_user			= "'.$forUser.'"
				WHERE task_id 	  = '.$id.'
				  AND task_status = "0"
				LIMIT 1;';
		if ($this->db->query($sql) === true) {
			return 'success';
		} else {
			return 'Error: '.$this->db->error;
		}
	}

	public function removeSelected(array $ids):string {
		$selectedIds = implode(',', $ids);
		$selectedIds = $this->db->real_escape_string($selectedIds);

		$sql = 'DELETE FROM tasks WHERE task_id IN ('.$selectedIds.') AND task_status = "0" LIMIT '.count($ids).';';
		if ($this->db->query($sql) === true) {
			return 'success';
		} else {
			return 'Error: '.$this->db->error;
		}
	}

	public function remove(int $id):string {
		$id = (int)$this->db->real_escape_string($id);

		$sql = 'DELETE FROM tasks WHERE task_id = '.$id.' AND task_status = "0" LIMIT 1;';
		if ($this->db->query($sql) === true) {
			return 'success';
		} else {
			return 'Error: '.$this->db->error;
		}
	}

	public function completed(int $id):string {
		$id 		 = (int)$this->db->real_escape_string($id);

		$sql = 'UPDATE tasks SET task_status = "1" WHERE task_id = '.$id.' LIMIT 1;';
		if ($this->db->query($sql) === true) {
			return 'success';
		} else {
			return 'Error: '.$this->db->error;
		}
	}

	public function info(int $id):array {
		$id = (int)$this->db->real_escape_string($id);

		$sql 	= 'SELECT * FROM tasks WHERE task_id = '.$id.' LIMIT 1;';
		$tasks  = $this->db->query($sql);

		if ($tasks->num_rows > 0) {
			$row = $tasks->fetch_assoc();
			return $row;
		} else {
			return array();
		}
	}
}

?>
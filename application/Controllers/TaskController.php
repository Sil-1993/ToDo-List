<?php

namespace TDL\Controllers;

use TDL\Core\Database;

class TaskController extends \TDL\Models\taskModel {

	public function __construct($action, $params) {
		// Initiate a database connection.
		parent::__construct();

		switch ($action) {
			case 'add':
				$name 			= $params['name'] 		 ?? '';
				$description 	= $params['description'] ?? '';
				$date 			= $params['date'] 		 ?? '';
				$forUser 		= $params['for-user'] 	 ?? '';

				$this->add($name, $description, $date, $forUser);
				break;
			case 'edit':
				$id 			= $params['id'] 		 ?? 0;
				$name 			= $params['name'] 		 ?? '';
				$description 	= $params['description'] ?? '';
				$date 			= $params['date'] 		 ?? '';
				$forUser 		= $params['for-user'] 	 ?? '';

				$this->edit($id, $name, $description, $date, $forUser);
				break;
			case 'remove-selected':
				$ids = $params['ids'] ?? array();

				$this->removeSelected($ids);
				break;
			case 'remove':
				$id = $params['id'] ?? 0;

				$this->remove($id);
				break;
			case 'completed':
				$id = $params['id'] ?? 0;

				$this->completed($id);
				break;
			case 'info':
				$id = $params['id'] ?? 0;

				$data = $this->info($id);
				echo json_encode($data);
				break;
			default:
				echo $this->view();
				break;
		}
	}
}

?>
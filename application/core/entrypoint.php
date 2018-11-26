<?php

namespace TDL\Core;

class Entrypoint {

    protected 	$controller = '';
	protected 	$action 	= '';

    public function __construct() {
		$this->splitUrl();
		$this->routeRequest();
    }


    public function splitUrl() {
		if (isset($_GET['url'])) {
			$parts = explode('/', $_GET['url']);

			$this->controller = $parts[0] ?? '';
			$this->action 	  = $parts[1] ?? '';
		}
	}

	public function routeRequest() {
		switch ($this->controller) {
			case 'task';
				$model = new \TDL\Controllers\TaskController($this->action, $_REQUEST);
				break;
			default:
				$model = new \TDL\Controllers\TaskController($this->action, $_REQUEST);
				break;
		}
	}
}

?>
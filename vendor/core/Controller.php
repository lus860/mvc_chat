<?php

namespace vendor\core;

use vendor\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $model;

	public function __construct($route)
    {
		$this->route = $route;
        $this->view = new View();
		$this->model = $this->loadModel($route['controller']);
		$this->unsetSession();
	}

	public function loadModel($name)
    {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path($this->route);
		}
	}

    public function unsetSession()
    {
        if (isset($_SESSION['success'])) {
            if ((time() - $_SESSION['success']['registered']) > (5)) {
                unset($_SESSION['success']);
            }
        }
    }

}
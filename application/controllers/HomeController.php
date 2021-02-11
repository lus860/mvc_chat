<?php

namespace application\controllers;

use vendor\core\Controller;

class HomeController extends Controller {

	public function indexAction() {

		$this->view->render('main.index','Home page');
	}

}
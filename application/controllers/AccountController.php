<?php

namespace application\controllers;

use vendor\core\Controller;

class AccountController extends Controller {

	public function loginAction() {
		$this->view->render('account.login','Вход');
	}

	public function registerAction() {
		$this->view->render('account.register','Регистрация');
	}

}
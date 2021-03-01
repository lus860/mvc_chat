<?php

namespace application\controllers;

use application\models\Album;
use vendor\core\Controller;
use application\models\Account;

class HomeController extends Controller {

	public function indexAction() {

	    $accounts = new Account();
        $accounts->setTable('accounts');
	    $users = $accounts->select()->fetch_obj();

        $album = [];
	    if (isset($_SESSION['user_id'])) {
            $album = new Album();
            $album->setTable('albums');
            $album = $album->select()->where(['user_id' => $_SESSION['user_id']])->fetch_obj();
        }

		$this->view->render('main.index','Home page',['users' => $users, 'album' => $album]);
	}

}
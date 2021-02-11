<?php

namespace application\controllers;

use vendor\core\Controller;

class ProfileController extends Controller {

    public function indexAction() {

        $this->view->render('profile.index','Edit Profile');
    }

    public function editAction() {

        $this->view->render('profile.index','Edit Profile');
    }

}
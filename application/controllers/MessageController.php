<?php

namespace application\controllers;

use vendor\core\Controller;

class MessageController extends Controller {

    public function indexAction() {

        $this->view->render('message.index','Send Message');
    }

    public function editAction() {

        $this->view->render('profile.index','Edit Profile');
    }

}
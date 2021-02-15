<?php

namespace application\controllers;

use vendor\core\Controller;
use application\models\Account;

class MessageController extends Controller {

    public function indexAction() {

        $id = $_GET['id'];
        $interlocutor = $this->model->interlocutor($id);
        $chat = $this->model->selectChat($id);
        $chatNew = [];

        foreach ($chat as $item) {
            $id = $item->id;
            unset($item->id);
            $chatNew["$id"] = $item;
        }

        ksort($chatNew);
        return $this->view->render('message.index','Send Message',[ 'chat' => $chatNew, 'interlocutor' => $interlocutor]);
    }

    public function createChatAction() {

        $message = $_POST['message'];
        $to = $_POST['id'];
        $from = $_SESSION['user_id'];
        if ($this->model->insert(['message' => $message, 'from' => $from, 'to' => $to])) {
            $time = time();
            $res = [
                'success'=> true,
                'time'=> date('Y-m-d H:i:s', $time),
            ];

            echo json_encode($res);
        } else {
            echo 0;
        }

    }

}
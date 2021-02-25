<?php

namespace application\controllers;

use vendor\core\Controller;
use application\models\Account;

class MessageController extends Controller {

    public function indexAction() {

        $id = $_GET['id'];
        $interlocutor = $this->model->interlocutor($id);
        $this->model->updateStatus($id);
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
            $res = [
                'success'=> false,
            ];
            echo json_encode($res);
        }

    }

    public function notificationAction()
    {
        $notification = $this->model->select()
            ->join("messages.from = accounts.id", $join = 'INNER', 'accounts')
            ->where(['to' => $_SESSION['user_id'], 'status' => 0])
            ->fetch_obj();

        $notifications = [];

        foreach ($notification as $item) {

            if ($item->prof_img && file_exists('images/profile/'.$item->prof_img)) {

                $prof_img = $item->prof_img;

            } else {

                $prof_img = 'default.jpg';
            }

            $from = [
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'prof_img' => $prof_img,
                'from' => $item->from,
                'count' => 1
            ];
            if (array_key_exists($item->from, $notifications)) {
                $notifications[$item->from]['count'] ++;

            } else {
                $notifications[$item->from] = $from;
            }

        }

        $notifications['countAll'] = count($notification);

        if ( $notifications ) {
            echo json_encode($notifications);
        } else {
            echo 'error';
        }

    }

}
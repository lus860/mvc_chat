<?php

namespace application\controllers;

use vendor\core\Controller;
use application\models\Account;
use application\models\Album;

class AlbumController extends Controller {

    const path = [
        'album' => IMAGES.'album',
        'profile' => IMAGES.'profile',
    ];


    public function albumAction() {

        $album = $this->model->select()->where(['user_id' => $_SESSION['user_id']])->fetch_obj();
        return $this->view->render('album.index','View Album',['album'=>$album]);

    }


    public function albumCreateAction() {

        return $this->view->render('album.create','Add Image');

    }

    public function albumAddAction() {

        if (isset($_POST['submit'])) {
            $count = count($_FILES['image']['name']);
            if ($count > 0) {
                $errors = array();
                $error_extensions = 0;
                $error_size = 0;
                $upload = 0;
                for ($i=0; $i <= $count; $i++) {
                    $current_error = false;
                    if (isset($_FILES['image']['name'][$i]) && $_FILES['image']['error'][$i] === 0) {
                        $file_name = $_FILES['image']['name'][$i];
                        $file_size = $_FILES['image']['size'][$i];
                        $file_tmp = $_FILES['image']['tmp_name'][$i];
                        $file_type = $_FILES['image']['type'][$i];
                        $file_ext = explode('.', $_FILES['image']['name'][$i]);
                        $file_ext = strtolower(end($file_ext));

                        $extensions = array("jpeg","jpg","png");

                        if (in_array($file_ext,$extensions) === false) {
                            $current_error = true;
                            $error_extensions++;
                            $mess = 'Extension is prohibited on'. $error_extensions .'files. Select a JPEG, PNG, or JPG file.';
                            $errors['error_extensions'] = $mess;
                        }

                        if ($file_size > 2097152) {
                            $current_error = true;
                            $error_size ++;
                            $mess = 'On' . $error_size .'files the size is prohibited. File size must be excately 2 MB';
                            $errors['error_size'] = $mess;
                        }

                        $file_name = md5($file_name . strtotime('now')) . '.' .$file_ext;
                        if ($current_error == false) {
                            if (!is_dir(self::path['album'].'/'.$_SESSION['user_id'])) {
                                mkdir(self::path['album'].'/'.$_SESSION['user_id']);
                            }
                            move_uploaded_file($file_tmp, self::path['album'].'/'.$_SESSION['user_id'].'/'.$file_name);
                            $album = new Album();
                            $album->setTable('albums');

                            $album->insert(['user_id' => $_SESSION['user_id'], 'img' => $file_name]);
                            $upload++;
                        }
                    }
                }

                if ($upload > 0) {

                    $_SESSION['success'] = array('mess' => $upload.' file has been uploaded', 'registered' => time());
                    $this->view->redirect('/album');

                } else {

                    $_SESSION['errors'] = array('mess' => '0 file has been uploaded', 'registered' => time());

                    $this->view->redirect('/album/create');
                }
            }
        }
    }

    public function imageDeleteAction() {

        $findImg = $this->model->find($_GET['id']);
        $img = $findImg['img'];
        $this->model->where(['id'=> $_GET['id']])->delete();
        if ($img && file_exists(self::path['album'].'/'.$_SESSION['user_id'].'/'.$img)) {
            unlink(self::path['album'].'/'.$_SESSION['user_id'].'/'.$img);
        }

        $this->view->redirect('/album');

    }

    public function albumUserAction() {

        $user = new Account();
        $user->setTable('accounts');
        $findUser = $user->find($_GET['id']);
        $album = $this->model->select()->where(['user_id' => $_GET['id']])->fetch_obj();
        return $this->view->render('album.albumUser','View Album',['album'=>$album, 'user'=>$findUser]);

    }


}


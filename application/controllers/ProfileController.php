<?php

namespace application\controllers;

use vendor\core\Controller;
use application\models\Account;
use application\models\Album;

class ProfileController extends Controller {

    const path = [
        'album' => IMAGES.'album',
        'profile' => IMAGES.'profile',
    ];

    public function image() {

            $errors = array();
            $error_extensions = 0;
            $error_size = 0;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_ext = explode('.', $_FILES['image']['name']);
                $file_ext = strtolower(end($file_ext));

                $extensions = array("jpeg","jpg","png");

                if (in_array($file_ext,$extensions) === false) {
                    $error_extensions++;
                    $mess = 'Extension is prohibited on'. $error_extensions .'files. Select a JPEG, PNG, or JPG file.';
                    $errors['error_extensions'] = $mess;

                }

                if ($file_size > 2097152) {
                    $error_size ++;
                    $mess = 'On' . $error_size .'files the size is prohibited. File size must be excately 2 MB';
                    $errors['error_size'] = $mess;

                }


                $file_name = time() . '.' .$file_ext;
                if (empty($errors) == true) {
                    if (!is_dir(self::path['album'])) {
                        mkdir(self::path['album']);
                    }
                    move_uploaded_file($file_tmp, self::path['album'].'\\'.$_SESSION['user_id'].'\\'.$file_name);
                    $album = new Album();
                    $album->setTable('albums');

                    $album->insert(['user_id' => $_SESSION['user_id'], 'img' => $file_name]);
                }
            } else {
                $_SESSION['errors'] = array('mess' => 'Image not found...!!!', 'registered' => time());            }
            $this->view->redirect('/profile');
    }

    public function indexAction() {

        $this->view->render('profile.index','Edit Profile');
    }

    public function editAction() {

        if (isset($_POST['submit'])) {
            $errors = array();
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_ext = explode('.', $_FILES['image']['name']);
                $file_ext = strtolower(end($file_ext));

                $extensions = array("jpeg","jpg","png");

                if (in_array($file_ext,$extensions) === false) {
                    $errors[] = "Extension not allowed, please choose a JPEG or PNG  or JPG file.";
                }

                if ($file_size > 2097152) {
                    $errors[] = 'File size must be excately 2 MB';
                }


                $file_name = time() . '.' .$file_ext;
                if (empty($errors) == true) {
                    if (!is_dir(self::path['profile'])) {
                        mkdir(self::path['profile']);
                    }
                    move_uploaded_file($file_tmp, self::path['profile'].'\\'.$file_name);
                    $user = new Account();
                    $user->setTable('accounts');
                    $findUser = $user->find($_SESSION['user_id']);
                    $oldImg = $findUser['prof_img'];
                    if ($oldImg && file_exists(self::path['profile'].'\\'.$oldImg)) {
                        unlink(self::path['profile'].'\\'.$oldImg);
                    }
                    $user->where(['id' => $_SESSION['user_id']])->update(['prof_img'=> $file_name]);
                    $_SESSION['prof_img'] = $file_name;
                    $_SESSION['success'] = array('mess' => 'Your profile has been updated', 'registered' => time());
                    $this->view->redirect('/');
                } else {
                    return $this->view->render('profile.index','Edit Profile', ['errors' => $errors]);
                }
            } else {
                $_SESSION['errors'] = array('mess' => 'Image not found...!!!', 'registered' => time());
            }
                $this->view->redirect('/profile');
        }

    }

    public function albumAction() {

        $album = new Album();
        $album->setTable('albums');
        $album = $album->select()->where(['user_id' => $_SESSION['user_id']])->fetch_obj();
        return $this->view->render('profile.album.index','View Album',['album'=>$album]);

    }


    public function albumCreateAction() {

        return $this->view->render('profile.album.create','Add Image');

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

                        $file_name = md5($file_name) . '.' .$file_ext;
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

        $album = new Album();
        $album->setTable('albums');
        $findImg = $album->find($_GET['id']);
        $img = $findImg['img'];
        $album->where(['id'=> $_GET['id']])->delete();
        if ($img && file_exists(self::path['album'].'/'.$_SESSION['user_id'].'/'.$img)) {
            unlink(self::path['album'].'/'.$_SESSION['user_id'].'/'.$img);
        }

        $this->view->redirect('/album');

    }

    public function sendMailAction() {


        $rules = [
            'name' => ['required','string'],
            'subject' => ['required'],
            'message' => ['required'],
            'email' => ['required', 'email'],

        ];

        $result = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'subject' => trim($_POST['subject']),
                'message' => trim($_POST['message']),
                'email' => trim($_POST['email']),
            ];

            $error = $this->validation($rules, $data);

            if (empty($error)) {
                $to = 'lusinehovhannisyan280@gmail.com';
                $headers = "From: webmaster@example.com" . "\r\n" .
                    "CC: somebodyelse@example.com";

                try {
                    mail($to, $data['subject'], $data['message'], $headers);
                    $_SESSION['success'] = array('mess' => 'Mail send', 'registered' => time());

                    $this->view->redirect('/');
                }catch (Exception $e){
                    $e->getMessage();

                }

            }
            $result = array_merge($error, $data);

            $_SESSION['errors_mail'] = array('mess' => $result, 'registered' => time());
            $this->view->redirect('/');
        }
    }

}
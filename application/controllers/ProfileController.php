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

//                $from = $data['email'];
//                $to = "lusinehovhannisyan280@gmail.com";
//                $subject = $data['subject'];
//                $message = $data['message'];
//                $headers = "";
//                $headers.="From: ".$from;
//                $headers.= "MIME-Version: 1.0\r\n";
//                $headers.= "Content-type: text/html; charset=UTF-8\r\n";
//                $mail = mail($to,$subject,$message,$headers);
//                if ($mail) {
//                    $_SESSION['success'] = array('mess' => 'Your message has been  successfully sent', 'registered' => time());
//                    $this->view->redirect('/');
//                } else {
//                    $_SESSION['errors_mail'] = array('mess' => $data, 'registered' => time());
//                    $_SESSION['errors'] = array('mess' => 'Your message has not been sent', 'registered' => time());
//                    $this->view->redirect('/');
//                }

                $mail = new PHPMailer();

// Settings
                $mail->IsSMTP();
                $mail->CharSet = 'UTF-8';

                $mail->Host       = "mail.example.com"; // SMTP server example
                $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;                  // enable SMTP authentication
                $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
                $mail->Username   = "username"; // SMTP account username example
                $mail->Password   = "password";        // SMTP account password example

// Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();


            }
            $result = array_merge($error, $data);

            $_SESSION['errors_mail'] = array('mess' => $result, 'registered' => time());
            $this->view->redirect('/');
        }
    }

}


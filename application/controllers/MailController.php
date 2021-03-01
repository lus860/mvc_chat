<?php

namespace application\controllers;

use vendor\core\Controller;
use application\models\Account;
use application\models\Album;

class MailController extends Controller {


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
                $mail = self::sendMail($data);
                if ($mail) {
                    $_SESSION['success'] = array('mess' => 'Your message has been  successfully sent', 'registered' => time());
                    $this->view->redirect('/');
                } else {
                    $_SESSION['errors_mail'] = array('mess' => $data, 'registered' => time());
                    $_SESSION['errors'] = array('mess' => 'Your message has not been sent', 'registered' => time());
                    $this->view->redirect('/');
                }
            }
            $result = array_merge($error, $data);

            $_SESSION['errors_mail'] = array('mess' => $result, 'registered' => time());
            $this->view->redirect('/');
        }
    }


    public static function sendMail($data) {
        $mail = new \PHPMailer;
        $mail->CharSet = MAIL_CHARSET;
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = MAIL_SMTPAuth;
        $mail->Username = MAIL_USER;
        $mail->Password = MAIL_PASS;
        $mail->SMTPSecure = MAIL_SMTPSECURE;
        $mail->Port = MAIL_PORT;
        $mail->AddEmbeddedImage(URL_ROOT.'/images/logo.png', 'logo_2u');
        $mail->setFrom('lusine.hovhannisyan@esterox.am');
        $mail->addAddress(MAIL_ADMIN);
        $mail->Subject = $data['subject'];
        $message = '<b>The following request was sent from: </b>';
        $message .= '<p>Name: '.$data['name'].'</p>';
        $message .= '<p>Email: '.$data['email'].'</p><hr>';
        $message .= '<p>Message: '.$data['message'].'</p>';
        $body = "<html>\n";
        $body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">";
        $body .= "<img src=".URL_ROOT."/images/logo.png"." style='width:100px;margin-bottom: 40px' ><br>";
        $body .= $message;
        $body .= "</body>\n";
        $body .= "</html>\n";
        $mail->Body    = $body;
        $mail->isHTML(MAIL_ISHtml);
        $mail->AltBody = '';

        if(!$mail->send()) {
           return false;
        } else {
            return true;
        }
    }

}


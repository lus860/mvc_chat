<?php

namespace application\controllers;

use vendor\core\Controller;

class AccountController extends Controller {

	public function loginAction() {

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'length'=> ['min'=> 8] ],
        ];

        $result = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
            ];

            $error = $this->validation($rules, $data);

            if (empty($error)) {
                $loggedInUser = $this->model->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->model->createUserSession($loggedInUser);
                } else {
                    $data['password_error'] = 'Password or email is incorrect. Please try again.';

                    return $this->view->render('account.login','Login',$data);
                }
            }
            $result = array_merge($error, $data);
        }

        $this->view->render('account.login','Login', $result);
	}

    public function registerAction() {

        $rules = [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique'],
            'password' => ['required', 'length'=> ['min'=> 8] ],
            'confirm_password' => ['required', 'confirmPassword'],
        ];

        $result = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
            ];

            $error = $this->validation($rules, $data);

            if (empty($error)) {
                unset($data['confirm_password']);
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                try {
                    $this->model->insert($data);
                    $_SESSION['success'] = array('mess' => 'Registration Successful. Please Login', 'registered' => time());

                    $this->view->redirect('/account/login');
                }catch (Exception $e){
                    $e->getMessage();

                }

            }
            $result = array_merge($error, $data);
        }
        $this->view->render('account.register','Register', $result);
    }



    public function logoutAction() {
        unset($_SESSION['user_id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['email']);
        unset($_SESSION['prof_img']);
        $this->view->redirect('/account/login');
    }

}
<?php

namespace vendor\core;

use vendor\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $model;
    public $acl;

    public $nameValidation = "/^[a-zA-Z0-9]*$/";

	public function __construct($route)
    {
		$this->route = $route;
        $this->view = new View();
        $this->checkAcl();
		$this->model = $this->loadModel($route['controller']);
		$this->unsetSession();
	}

	public function loadModel($name)
    {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path($this->route);
		}
	}

    public function unsetSession()
    {
        if (isset($_SESSION['success'])) {
            if ((time() - $_SESSION['success']['registered']) > (5)) {
                unset($_SESSION['success']);
            }
        }

        if (isset($_SESSION['errors'])) {
            if ((time() - $_SESSION['errors']['registered']) > (5)) {
                unset($_SESSION['errors']);
            }
        }

        if (isset($_SESSION['errors_mail'])) {
            if ((time() - $_SESSION['errors_mail']['registered']) > (5)) {
                unset($_SESSION['errors_mail']);
            }
        }
    }

    public function checkAcl()
    {
        $this->acl = require BASE_URL.'/configs/acl/'.$this->route['controller'].'.php';

        if (isset($_SESSION['user_id']) and $this->isAcl('authorize')) {
            $this->view->redirect('/');
        }
        elseif (!isset($_SESSION['user_id']) and $this->isAcl('guest')) {
            $this->view->redirect('/account/login');
        }
//
//        return false;
    }

    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }

    public function validation($rules, $data)
    {
        $error = [];
        foreach ($rules as $key => $val) {
            $newVal = implode(" ", explode("_", $key));
            if(in_array('required',$val)) {
                if (empty($data[$key])) {
                    $error[$key.'_error'] = "Please enter $newVal.";
                }
            }

            if(in_array('string',$val)) {
                if (!empty($data[$key]) && !preg_match($this->nameValidation, $data[$key])) {
                    $error[$key.'_error'] = ucfirst($newVal). " can only contain letters and numbers.";
                }
            }

            if(in_array('email',$val)) {
                if (!empty($data[$key]) && !filter_var($data[$key], FILTER_VALIDATE_EMAIL)) {
                    $error[$key.'_error'] = 'Please enter the correct format.';
                }
            }

            if(in_array('unique',$val)) {
                if (!empty($data[$key]) && $this->model->findUserByEmail($data[$key])) {
                    $error[$key.'_error'] = ucfirst($newVal). ' is already taken.';
                }
            }

            if(array_key_exists('length', $val)) {
                if (!empty($data[$key]) && isset($val['length']['min'])) {
                    if (strlen($data[$key]) < $val['length']['min']) {
                        $error[$key.'_error'] = ucfirst($newVal). ' must be at least '. $val['length']['min'] .' characters';
                    }
                }
                if (!empty($data[$key]) && isset($val['length']['max'])) {
                    if (strlen($data[$key]) > $val['length']['max']) {
                        $error[$key.'_error'] = ucfirst($newVal). ' must be no more than '. $val['length']['max'] .' characters';
                    }
                }

            }

            if(!empty($data[$key]) && in_array('confirmPassword',$val)) {
                if ($data['password'] != $data[$key]) {
                    $error[$key.'_error'] = 'Passwords do not match, please try again.';
                }
            }

        }
        return $error;
    }


}
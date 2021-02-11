<?php

namespace application\models;

use vendor\core\Model;

class Account extends Model {


    public $nameValidation = "/^[a-zA-Z0-9]*$/";

    public function findUserByEmail($email) {
        $count = $this->select()->where(['email' => $email])->rowCount();

        if($count > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function login($email, $password) {
        $row = $this->select()->where(['email' => $email])->single();

        $hashedPassword = $row["password"];

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user["id"];
        $_SESSION['first_name'] = $user["first_name"];
        $_SESSION['email'] = $user["email"];
        header('location:' . URL_ROOT . '/');
    }



}
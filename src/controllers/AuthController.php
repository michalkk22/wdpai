<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends AppController
{
    public function login()
    {
        $mockUser = new User('asdd', 'qwee', 'nicky');

        if (!$this->isPost()) {
            return $this->login();
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($mockUser->getEmail() != $email) {
            return $this->render('login', ['messages' => ['Wrong email']]);
        }

        if ($mockUser->getPassword() != $password) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

        // return $this->render('main');
        $url = "http://" . $_SERVER["HTTP_HOST"];
        header("Location: {$url}/main");
    }
}
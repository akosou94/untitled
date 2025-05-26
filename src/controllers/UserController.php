<?php

namespace App\controllers;

use App\repositories\UserStore\UserStoreRepository;
use App\View;

class UserController
{
    public UserStoreRepository $store;

    public function __construct(UserStoreRepository $store) {
        $this->store = $store;
    }

    public function login() {
        echo View::render('login');
    }

    public function signIn() {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $users = $this->store->read();

            $username = $_POST['login'];
            $password = $_POST['password'];

            foreach ($users as $user) {
                $userKey = key($user);
                $userValue = current($user);

                if ($username === $userKey && $password === $userValue) {
                    $_SESSION['user'] = $username;
                    header('Location: /');
                    exit();
                } else {
                    header('Location: /login');
                    exit();
                }
            }
        }
    }

}
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

    public function getCredentials(): ?array {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            return [
                'login'    => $_POST['login'],
                'password' => $_POST['password'],
            ];
        }

        return null;
    }

    public function findUser(string $username, string $password): bool {
        $users = $this->store->read();

        foreach ($users as $user) {
            $userKey = key($user);
            $userValue = current($user);

            if ($username === $userKey && $password === $userValue) {
                return true;
            }
        }

        return false;
    }

    public function signIn() {
        $credentials = $this->getCredentials();

        if (!$credentials) {
            header('Location: /');
            exit();
        }

        $username = $credentials['login'];
        $password = $credentials['password'];

        if ($this->findUser($username, $password)) {
            $_SESSION['user'] = $username;
            header('Location: /');
        } else {
            header('Location: /login/sign-up');
        }
    }

    public function isUserExists(string $username): bool {
        $users = $this->store->read();

        foreach ($users as $user) {
            if (key($user) === $username) {
                return true;
            }
        }

        return false;
    }

    public function signUp() {
        $credentials = $this->getCredentials();

        if (!$credentials) {
            echo View::render('sign-up');

            return false;
        }

        $username = $_POST['login'];
        $password = $_POST['password'];

        if ($this->isUserExists($username)) {
            echo View::render('sign-up');

            return false;
        }
        
        $users = $this->store->read();
        $users[] = [$username => $password];
        $this->store->write($users);

        $_SESSION['user'] = $username;

        header('Location: /');
        exit();
    }
}
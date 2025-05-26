<?php

use App\controllers\TodoController;
use App\controllers\UserController;
use App\repositories\TodoStore\TodoStoreRepository;
use App\repositories\UserStore\UserStoreRepository;
use App\Router;
use App\session\Session;

require_once "vendor/autoload.php";

$session = Session::getInstance();
$userStore = new UserStoreRepository(__DIR__.'/users.json');
$todoStore = new TodoStoreRepository(__DIR__.'/store.json');

$userController = new UserController($userStore);
$todoController = new TodoController($todoStore);

(new Router())->add('/', fn() => $todoController->index())
    ->add('/todo/add', fn() => $todoController->add())
    ->add('/todo/done', fn() => $todoController->done())
    ->add('/login', fn() => $userController->login())
    ->add('/login/sign-in', fn() => $userController->signIn())
    ->add('/login/logout', fn() => $session->destroy())
    ->run();

/*
 * Задание TODO LIST: революция
 *
 * - сделать классы UserController и UserStore
 * - в user.json пока что давай засунем просто объект
 *
 * {
 *  "admin": "1234"
 * }
 *
 * То есть логин и пароль.
 *
 * - сделать view login.php и метод login() в контроллере. И роут /login
 * - сделать форму авторизации. Можно чтобы форма слала запрос сама на себя.
 * - реализовать логику авторизации через php session (почитать). То есть пользователь вводит логин и пароль и мы проверяем есть ли такой логин и пароль в нашем json и если есть вызываем метода авторизации
 * - для страниц todo controller сделать что на них можно заходить ТОЛЬКО если пользователь авторизирован
 * - сделать путь в роутере /logout и метод logout реализовать выход.
 *
 * Почитать:
 * https://www.php.net/manual/en/ref.session.php
 * $_SESSION
*/

?>

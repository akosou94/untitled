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
?>

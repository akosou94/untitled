<?php

use App\controllers\TodoController;
use App\repositories\TodoStore\TodoStoreRepository;
use App\Router;

require_once "vendor/autoload.php";


$router = new Router();

$router->add('/', function () {
    $store = new TodoStoreRepository(__DIR__.'/store.json');
    $todoController = new TodoController($store);
    $todoController->index();
})->add('/todo/add', function () {
    $store = new TodoStoreRepository(__DIR__.'/store.json');
    $todoController = new TodoController($store);
    $todoController->addRoute();
})->add('/todo/done', function () {
    $store = new TodoStoreRepository(__DIR__.'/store.json');
    $todoController = new TodoController($store);
    $todoController->doneRoute();
})->run();

?>

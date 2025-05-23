<?php

use App\controllers\TodoController;
use App\models\Todo\TodoItemModel;
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Todo'])) {
            $text = $_POST['Todo'];

            $newTodo = new TodoItemModel(time(), $text, false);
            $todoController->add($newTodo);
            header('Location: /');
        }
    }
})->add('/todo/done', function () {
    $store = new TodoStoreRepository(__DIR__.'/store.json');
    $todoController = new TodoController($store);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Todo_id'])) {
            $todoId = (int)$_POST['Todo_id'];
            $isDone = isset($_POST['complete']);

            $todoController->done($todoId, $isDone);
            header('Location: /');
        }
    }
})->run();

?>

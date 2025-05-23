<?php

use App\controllers\TodoController;
use App\repositories\TodoStore\TodoStoreRepository;
use App\Router;

require_once "vendor/autoload.php";

$store = new TodoStoreRepository(__DIR__.'/store.json');
$todoController = new TodoController($store);

(new Router())->add('/', fn() => $todoController->index())
    ->add('/todo/add', fn() => $todoController->add())
    ->add('/todo/done', fn() => $todoController->done())
    ->run();

?>

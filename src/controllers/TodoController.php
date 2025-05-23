<?php

namespace App\controllers;

use App\models\Todo\TodoItemModel;
use App\repositories\TodoStore\TodoStoreRepository;
use App\View;

class TodoController
{
    public TodoStoreRepository $store;

    public function __construct(TodoStoreRepository $store) {
        $this->store = $store;
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Todo'])) {
                $text = $_POST['Todo'];

                $newTodo = new TodoItemModel(time(), $text, false);
                if (empty($newTodo->title)) {
                    return false;
                }

                $data = $this->store->read();
                $data[] = $newTodo->toArray();


                return $this->store->write($data);
            }
        }

        header('Location: /');
    }

    public function done() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Todo_id'])) {
                $todoId = (int)$_POST['Todo_id'];
                $isDone = isset($_POST['complete']);


                $data = $this->store->read();

                foreach ($data as $key => $item) {
                    if ($item['id'] === $todoId) {
                        $data[$key]['done'] = $isDone;
                    }
                }


                return $this->store->write($data);
            }
        }
        
        header('Location: /');
    }

    public function index(): void {
        $todos = $this->store->read();

        echo View::render('index', ['todos' => $todos]);
    }
}

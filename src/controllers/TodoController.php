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

    public function add(TodoItemModel $todo): bool {
        if (empty($todo->title)) {
            return false;
        }

        $data = $this->store->read();
        $data[] = $todo->toArray();

        return $this->store->write($data);
    }

    public function done(int $id, bool $checked): bool {
        $data = $this->store->read();

        foreach ($data as $key => $item) {
            if ($item['id'] === $id) {
                $data[$key]['done'] = $checked;
            }
        }

        return $this->store->write($data);
    }

    public function index(): void {
        $todos = $this->store->read();

        echo View::render('index', ['todos' => $todos]);
    }

    public function addRoute(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Todo'])) {
                $text = $_POST['Todo'];

                $newTodo = new TodoItemModel(time(), $text, false);
                $this->add($newTodo);
            }
        }

        $this->index();
    }

    public function doneRoute(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Todo_id'])) {
                $todoId = (int)$_POST['Todo_id'];
                $isDone = isset($_POST['complete']);

                $this->done($todoId, $isDone);
            }
        }

        $this->index();
    }
}

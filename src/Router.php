<?php

namespace App;

class Router
{
    protected array $urls = [];

    public function add(string $path, callable $function): static {
        $this->urls[$path] = $function;

        return $this;
    }

    public function run(): void {
        $path = $_SERVER['REQUEST_URI'];

        if (isset($this->urls[$path])) {
            $this->urls[$path]();
        } elseif (!isset($this->urls[$path])) {
            http_response_code(404);
            echo 'Страница не найдена';
            exit(0);
        } else {
            header('Location: /');
            exit(0);
        }
    }
}
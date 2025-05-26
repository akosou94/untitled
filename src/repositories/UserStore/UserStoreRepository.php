<?php

namespace App\repositories\UserStore;

class UserStoreRepository
{
    public $file;

    public function __construct($file) {
        $this->file = $file;

        if (!is_writable($this->file)) {
            echo "Файл {$this->file} недоступен для записи";
            exit;
        }
    }

    public function read(): ?array {
        $file = file_get_contents($this->file);

        $data = json_decode($file, true);

        if ($this->hasError()) {
            return null;
        }

        return $data;
    }

    public function write($data) {
        $jsonString = json_encode($data, JSON_PRETTY_PRINT);

        if (file_put_contents($this->file, $jsonString) === false) {
            echo "Не могу произвести запись в файл {$this->file}";

            return false;
        }

        return true;
    }

    public function hasError(): bool {
        return json_last_error() !== JSON_ERROR_NONE;
    }
}
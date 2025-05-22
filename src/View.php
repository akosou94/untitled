<?php

namespace App;

class View
{
    public static function render(string $viewPath, array $data = []): string {
        $viewFile = __DIR__.'/../views/'.$viewPath.'.php';

        if (!file_exists($viewFile)) {
            throw new Exception("View file not found: {$viewFile}");
        }


        extract($data);
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        return $content;
    }
}
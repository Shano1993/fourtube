<?php

class ErrorController
{
    public function error404(string $page)
    {
        require __DIR__ . '/../View/error/error404.html.php';
    }

    public function missingParameters()
    {
        require __DIR__ . '/../View/error/missing-parameters.html.php';
    }
}

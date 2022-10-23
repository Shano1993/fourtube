<?php

namespace App\Routing;

use App\Controller\HomeController;
use ErrorController;

class HomeRouter extends AbstractRouter
{
    public static function route(?string $action = null)
    {
        $controller = new HomeController();
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }
}
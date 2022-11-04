<?php

namespace App\Routing;

use App\Controller\CommentController;
use ErrorController;

class CommentRouter extends AbstractRouter {
    public static function route(?string $action = null)
    {
        $controller = new CommentController();
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'add-comment':
                self::routeWithParams($controller, 'addComment', ['id' => 'int']);
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }
}

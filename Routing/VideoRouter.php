<?php

namespace App\Routing;

use App\Controller\VideoController;
use ErrorController;

class VideoRouter extends AbstractRouter
{
    public static function route(?string $action = null)
    {
        $controller = new VideoController();
        switch ($action) {
            case 'index':
                $controller->index();
               break;
            case 'add-video':
                $controller->addVideo('assets/video/');
                break;
            case 'watch-video':
                self::routeWithParams($controller, 'watchVideo', ['id' => 'int']);
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }
}

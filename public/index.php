<?php

use App\Routing\AbstractRouter;
use App\Routing\CommentRouter;
use App\Routing\HomeRouter;
use App\Routing\UserRouter;
use App\Routing\VideoRouter;

require __DIR__ . '/../includes.php';
session_start();

$page = isset($_GET['c']) ? AbstractRouter::secured($_GET['c']) : 'home';
$method = isset($_GET['a']) ? AbstractRouter::secured($_GET['a']) : 'index';

switch ($page) {
    case 'home':
        HomeRouter::route($method);
        break;
    case 'user':
        UserRouter::route($method);
        break;
    case 'video':
        VideoRouter::route($method);
        break;
    case 'comment':
        CommentRouter::route($method);
        break;
    default:
        (new ErrorController())->error404($page);
}
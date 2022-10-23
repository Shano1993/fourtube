<?php

namespace App\Controller;

use App\Model\Manager\VideoManager;

class HomeController extends AbstractController
{
    public function index()
    {
        $this->render('home/index', [
            'show_video' => VideoManager::getAll()
        ]);
    }
}
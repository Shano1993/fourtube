<?php

namespace App\Controller;

use App\Model\Manager\CommentManager;
use App\Model\Manager\VideoManager;

class CommentController extends AbstractController {
    public function index()
    {
        header('location: /index.php?c=home');
    }

    public function addComment(int $id) {
        if (!UserController::userConnected()) {
            header('location: /index.php?c=home');
            exit();
        }
        if ($this->isFormSubmitted()) {
            $user = $_SESSION['user']->getId();
            $content = $this->sanitizeString($this->getField('comment'));

            CommentManager::addComment($content, $user, $id);
            $_SESSION['success'] = "Commentaire ajouté !";
            $this->index();
        }
        $this->render('comment/add-comment', [
            'video' => VideoManager::getVideo($id)
        ]);
    }
}
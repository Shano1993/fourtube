<?php

namespace App\Controller;

use App\Model\Entity\Video;
use App\Model\Manager\VideoManager;

class VideoController extends AbstractController
{
    public function index()
    {
        if (UserController::userConnected()) {
            $this->render('video/add-video');
        }
        else {
            header('location: /index.php?c=home');
        }
    }

    public function addVideo($directory)
    {
        if (!UserController::userConnected()) {
            header('location: /index.php?c=home');
            exit();
        }
        if ($this->isFormSubmitted()) {
            if (isset($_FILES["videoName"]) && $_FILES["videoName"]["error"] === 0) {
                $allowedMimeType = ['video/x-msvideo', 'video/mpeg', 'video/mp4'];
                if (in_array($_FILES['videoName']['type'], $allowedMimeType)) {
                    $maxSize = 800 * 1024 * 1024;
                    if ((int)$_FILES['videoName']['size'] <= $maxSize) {
                        $tmp_name = $_FILES['videoName']['tmp_name'];
                        $name = $_FILES['videoName']['name'];
                        $name = $this->getRandomName($name);
                        if (!is_dir($directory)) {
                            mkdir($directory, '0755');
                        }
                        if (AbstractController::checkVideoMime($tmp_name)) {
                            if (move_uploaded_file($tmp_name, $directory . $name)) {
                                $tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'br', 'hr', 'b', 'font', 'i', 'a', 'ul', 'ol', 'li',
                                    'table', 'th', 'tr', 'td', 'thead', 'tbody', 'tfoot', 'span', 'div', 'style'
                                ];
                                $title = $this->sanitizeString($this->getField('title'));
                                $content = strip_tags($this->getField('content'), $tags);
                                $author = $_SESSION['user'];

                                $video = new Video();
                                $video
                                    ->setTitle($title)
                                    ->setContent($content)
                                    ->setVideoName($name)
                                    ->setAuthor($author)
                                ;

                                if (VideoManager::addNewVideo($video)) {
                                    $_SESSION['success'] = "Vidéo ajoutée avec succés !";
                                    $this->render('home/index');
                                }
                            }
                        }
                        else {
                            $_SESSION['errors'] = "Bien essayé ! Mais ce n'est pas une vidéo !";
                            $this->render('video/add-video');
                        }
                    }
                    else {
                        $_SESSION['errors'] = "Le fichier est trop volimineux.";
                        $this->render('video/add-video');
                    }
                }
                else {
                    $_SESSION['errors'] = "Mauvais format de vidéo.";
                    $this->render('video/add-video');
                }
            }
            else {
                $_SESSION['errors'] = "Une erreur est survenue !";
                $this->render('video/add-video');
            }
        }
        $this->render('video/add-video');
        exit();
    }

    public function watchVideo(int $id) {
        $this->render('video/watch-video', [
            'show_video' => VideoManager::getVideo($id)
        ]);
    }
}

<?php

use App\Controller\AbstractController;
use App\Controller\UserController;
use App\Model\Entity\Video;
use App\Model\Manager\CommentManager;

?>

<div id="divVideo">
    <video src="/assets/video/<?= $data['show_video']->getVideoName() ?>" class="videoId" controls></video>
    <p id="titleVideoId"><?= $data['show_video']->getTitle() ?></p>
    <p id="usernameId"><?=  $data['show_video']->getAuthor()->getUsername() ?></p>
    <div class="content">
        <h2 id="description">Description</h2>
        <p id="content"><?= $data['show_video']->getContent() ?></p>
        <div id="comment">
            <?php
            if (UserController::userConnected()) { ?>
                <a class="addComment" href="/index.php?c=comment&a=add-comment&id=<?= $data['show_video']->getId() ?>">Ajouter un commentaire</a> <?php
            } ?>

            <?php
            foreach (CommentManager::getCommentByVideo($data['show_video']) as $value) { ?>
                <div class="comments">
                    <p class="author">De <?= $value->getAuthor()->getUsername() ?></p>
                    <p class="commentary"><?= $value->getContent() ?></p>
                </div> <?php
            } ?>
        </div>
    </div>
</div>




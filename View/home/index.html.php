<?php

use App\Model\Entity\Video;
use App\Model\Manager\UserManager;

?>

<div id="viewVideo"> <?php
    foreach ($data['show_video'] as $video) {
        /* @var Video $video */ ?>
        <div id="videoName">
            <div id="vdo">
                <video src="/assets/video/<?= $video->getVideoName() ?>" class="videos"></video>
                <div id="video_block">
                    <a href= "/index.php?c=video&a=watch-video&id=<?= $video->getId() ?>" id="titleVideo"><?= $video->getTitle() ?></a>
                    <p id="username"><?=  $video->getAuthor()->getUsername() ?></p>
                </div>
            </div>
        </div> <?php
    } ?>
</div>

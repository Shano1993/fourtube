<?php

use App\Model\Entity\Video;
use App\Model\Manager\UserManager;

?>

<div id="viewVideo"> <?php
    foreach ($data['show_video'] as $video) {
        /* @var Video $video */ ?>
        <div id="videoName">
            <div id="vdo">
                <video src="/video/<?= $video->getVideoName() ?>" class="videos"></video>
                <div id="video_block">
                    <h2 id="titleVideo"><?= $video->getTitle() ?></h2>
                    <p id="username"><?=  $video->getAuthor()->getUsername() ?></p>
                </div>
            </div>
        </div> <?php
    } ?>
</div>

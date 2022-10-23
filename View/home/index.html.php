<?php

use App\Model\Entity\Video;

?>

<div id="viewVideo"> <?php
    foreach ($data['show_video'] as $video) {
        /* @var Video $video */ ?>
        <div id="videoName">
            <div id="vdo">
                <p id="titleVideo"><?= $video->getTitle() ?></p>
                <video src="/video/<?= $video->getVideoName() ?>"></video>
            </div>
        </div> <?php
    } ?>
</div>

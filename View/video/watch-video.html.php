<?php

use App\Model\Entity\Video;

?>

<div id="divVideo">
    <video src="/assets/video/<?= $data['show_video']->getVideoName() ?>" class="videoId" controls></video>
    <p id="titleVideoId"><?= $data['show_video']->getTitle() ?></p>
    <p id="usernameId"><?=  $data['show_video']->getAuthor()->getUsername() ?></p>
    <div class="content">
        <h2 id="description">Description</h2>
        <p id="content"><?= $data['show_video']->getContent() ?></p>
    </div>
</div>




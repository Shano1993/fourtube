<?php

$video = $data['video'];

?>

<h1>Ajouter un commentaire</h1>

<form action="/index.php?c=comment&a=add-comment&id=<?= $video->getId() ?>" method="post" class="formRegister">
    <div>
        <label for="comment"></label>
        <textarea name="comment" id="comment" cols="100" rows="10" minlength="2" required></textarea>
    </div>

    <input type="submit" name="save" class="articleSave" value="Ajouter" required>
</form>

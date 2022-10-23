<h1>Ajouter une vidéo</h1>

<form action="" id="addVideo" method="post" enctype="multipart/form-data">
    <div>
        <label for="title"></label>
        <input type="text" name="title" id="title" placeholder="Titre de la vidéo" maxlength="255" minlength="2" required>
    </div>
    <div>
        <label for="content"></label>
        <textarea name="content" id="content" cols="80" rows="20" placeholder="Description de la vidéo" minlength="2" required></textarea>
    </div>
    <div>
        <label for="videoName"></label>
        <input type="file" name="videoName" id="videoName" required>
    </div>
    <input type="submit" name="save" class="videoSave" value="Ajouter la vidéo ?" required>
</form>

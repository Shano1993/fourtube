<h1>Connexion</h1>

<form action="/index.php?c=user&a=login" method="post" id="login">
    <div>
        <label for="email"></label>
        <input type="email" name="email" id="email" maxlength="150" minlength="5" required placeholder="Votre email">
        <label for="password"></label>
        <input type="password" name="password" id="password" maxlength="255" minlength="5" required placeholder="Votre mot de passe">
    </div>
    <input type="submit" name="save" class="articleSave" value="Se connecter" id="submitLogin" required>
</form>

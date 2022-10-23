<h1>Formulaire d'inscription</h1>
<form action="/index.php?c=user&a=register" method="post" id="register">
    <div class="info">
        <label for="username"></label>
        <input type="text" name="username" id="username" maxlength="45" minlength="2" placeholder="Votre pseudo">
    </div>
    <div class="info">
        <label for="firstname"></label>
        <input type="text" name="firstname" id="firstname" maxlength="35" minlength="2" required placeholder="Votre prénom">
    </div>
    <div class="info">
        <label for="lastname"></label>
        <input type="text" name="lastname" id="lastname" maxlength="35" minlength="2" required placeholder="Votre nom">
    </div>
    <div class="info">
        <label for="email"></label>
        <input type="email" name="email" id="email" maxlength="150" minlength="5" required placeholder="Votre email">
    </div>
    <div class="info">
        <label for="password"></label>
        <input type="password" name="password" id="password" maxlength="255" minlength="5" required placeholder="Mot de passe">
    </div>
    <div class="info">
        <label for="passwordRepeat"></label>
        <input type="password" name="password-repeat" id="passwordRepeat" maxlength="255" minlength="5" required placeholder="Confirmer votre mot de passe">
    </div>
    <div class="info">
        <label for="age"></label>
        <input type="number" name="age" id="age" max="120" min="16" required placeholder="Votre âge">
    </div>
    <input type="submit" name="save" class="articleSave" value="S'inscrire" id="submitRegister" required>
</form>
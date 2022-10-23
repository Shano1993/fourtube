<?php
    use App\Controller\AbstractController;

    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']); ?>
            <div class="error"><?= $errors ?></div> <?php
    }
    if (isset($_SESSION['success'])) {
        $message = $_SESSION['success'];
        unset($_SESSION['success']); ?>
            <div class="success"><?= $message ?></div> <?php
    } ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Fourtube</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="sectionBar" id="menu">
                <ul>
                    <li>
                        <i class="fas fa-bars"></i>
                    </li>
                    <a href="/index.php?c=home"><img src="/assets/img/logo.png" alt="logo" id="logo"></a>
                </ul>
            </div>
            <div class="sectionBar" id="searchBar">
                <ul>
                    <li>
                        <label for="search"></label>
                        <input type="text" id="search" placeholder="Rechercher">
                    </li>
                </ul>
            </div>
            <div class="sectionBar" id="signUp"> <?php

                if (AbstractController::userConnected()) { ?>
                    <ul>
                        <li><a href="/index.php?c=video&a=add-video"><i class="fas fa-video"></i></a></li>
                        <li><a href="/index.php?c=user&a=logout" id="login">Se déconnecter</a></li>
                        <li><a href="" id="register">Profil</a></li>
                    </ul> <?php
                }
                else { ?>
                    <ul>
                        <li><a href="/index.php?c=user&a=login" id="login">Se connecter</a></li>
                        <li><a href="/index.php?c=user&a=register" id="register">S'inscrire</a></li>
                    </ul> <?php
                } ?>
            </div>
        </nav>
    </header>
    <p><?=$html?></p>

    <script src="/assets/js/app.js"></script>
    <script src="https://kit.fontawesome.com/84aafb4cd1.js" crossorigin="anonymous"></script>
</body>
</html>
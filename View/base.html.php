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
                    <img src="/assets/img/logo.png" alt="logo" id="logo">
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
            <div class="sectionBar" id="signUp">
                <ul>
                    <li>
                        <a href="/index.php?c=user&a=login" id="login">Se connecter</a>
                    </li>
                    <li>
                        <a href="/index.php?c=user&a=register" id="register">S'inscrire</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <p><?=$html?></p>

    <script src="https://kit.fontawesome.com/84aafb4cd1.js" crossorigin="anonymous"></script>
</body>
</html>
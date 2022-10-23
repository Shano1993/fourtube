<?php

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{
    public function index()
    {
        if (self::adminConnected()) {
            $this->render('user/users-list', [
                'users_list' => UserManager::getAll()
            ]);
        }
        else {
            header('location: /index.php?c=home');
        }
    }

    public function login()
    {
        if (self::userConnected()) {
            header('location: /index.php?c=home');
        }
        if ($this->isFormSubmitted()) {
            $email = $this->sanitizeString($this->getField('email'));
            $password = $this->getField('password');

            $user = UserManager::getUserByMail($email);
            if (null === $user) {
                $_SESSION['errors'] = "L'adresse mail est incorrect !";
                header('location: /index.php?c=home');
            }
            else {
                if (password_verify($password, $user->getPassword())) {
                    $user->setPassword('');
                    $_SESSION['user'] = $user;
                    header('location: /index.php?c=home');
                }
                else {
                    $_SESSION['errors'] = "Le mot de passe ne correspond pas.";
                }
            }
        }
        $this->render('user/login');
    }

    public function register()
    {
        if (self::userConnected()) {
            header('location / index.php?c=home');
        }
        if ($this->isFormSubmitted()) {
            $username = trim($this->sanitizeString($this->getField('username')));
            $firstname = trim($this->sanitizeString($this->getField('firstname')));
            $lastname = trim($this->sanitizeString($this->getField('lastname')));
            $email = filter_var($this->getField('email'), FILTER_SANITIZE_EMAIL);
            $password = $this->getField('password');
            $passwordRepeat = $this->getField('password-repeat');
            $age = (int)$this->getField('age', 0);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors'] = "L'adresse email n'est pas au bon format.";
            }
            if (strlen($username) <= 2 || strlen($username) >= 45) {
                $_SESSION['errors'] = "Le pseudo doit contenir entre 2 et 45 caractères.";
            }
            if (strlen($firstname) <= 2 || strlen($firstname) >= 35) {
                $_SESSION['errors'] = "Le prénom doit contenir entre 2 et 35 caractères.";
            }
            if (strlen($lastname) <= 2 || strlen($lastname) >= 45) {
                $_SESSION['errors'] = "Le nom doit contenir entre 2 et 35 caractères.";
            }
            if ($password !== $passwordRepeat) {
                $_SESSION['errors'] = "Les mots de passe ne correspondent pas.";
            }
            if (!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
                $_SESSION['errors'] = "Le mot de passe doit contenir une majuscule, un chiffre et un caractère special.";
            }
            if ($age <= 16 || $age >= 120) {
                $_SESSION['errors'] = "Vous n'avez pas l'âge recquis pour vous inscrire.";
            }
            else {
                $user = new User();
                $role = RoleManager::getRolesByName('user');
                $user
                    ->setUsername($username)
                    ->setFirstname($firstname)
                    ->setLastname($lastname)
                    ->setEmail($email)
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                    ->setAge($age)
                    ->setRoles([$role])
                ;
                if (!UserManager::mailUserExist($user->getEmail())) {
                    if (!UserManager::usernameUserExist($user->getUsername())) {
                        UserManager::addUser($user);
                        if (null !== $user->getId()) {
                            $_SESSION['user'] = $user;
                            header('location: /index.php?c=home');
                        }
                        else {
                            $_SESSION['errors'] = "Impossible de vous enregistrer.";
                        }
                    }
                    else {
                        $_SESSION['errors'] = "Le pseudo est déjà utilisé.";
                    }
                }
                else {
                    $_SESSION['errors'] = "L'adresse email est déjà utilisée.";
                }
            }
        }
        $this->render('user/register');
        exit();
    }

    public function logout(): void
    {
        if (!self::userConnected()) {
            header('location: /index.php?c=home');
        }
        if (self::userConnected()) {
            $_SESSION['user'] = null;
            $_SESSION['errors'] =null;
            $_SESSION['success'] = null;
            session_destroy();
        }
        $_SESSION['success'] = "Déconnexion réussie, à bientôt !";
        $this->index();
    }
}

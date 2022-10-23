<?php

namespace App\Controller;

use Exception;

abstract class AbstractController
{
    abstract public function index();

    public function render(string $temp, array $data = [])
    {
        ob_start();
        require __DIR__ . '/../View/' . $temp . '.html.php';
        $html = ob_get_clean();
        require __DIR__ . '/../View/base.html.php';
    }

    public function getField(string $field, $default = null)
    {
        if (!isset($_POST[$field])) {
            return (null === $default) ? '' : $default;
        }
        return $_POST[$field];
    }

    public static function isFormSubmitted(): bool
    {
        return isset($_POST['save']);
    }

    public static function userConnected(): bool
    {
        return isset($_SESSION['user']) && null !== ($_SESSION['user'])->getId();
    }

    public static function adminConnected(): bool
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            foreach ($user->getRoles() as $role) {
                $current = $role->getRoleName();
                if ($current === 'admin') {
                    return true;
                }
            }
        }
        return false;
    }

    public static function sanitizeString(string $param): string{
        return filter_var($param, FILTER_SANITIZE_STRING);
    }

    public static function getRandomName(string $randomName): string
    {
        $infos = pathinfo($randomName);
        try {
            $bytes = random_bytes(20);
        }
        catch (Exception $exception) {
            $bytes = openssl_random_pseudo_bytes(20);
        }
        return bin2hex($bytes) . '.' . $infos['extension'];
    }

    public static function checkVideoMime($tmpname): bool
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mtype = finfo_file($finfo, $tmpname);
        if (strpos($mtype, 'video/') === 0) {
            return true;
        }
        finfo_close($finfo);
        return false;
    }
}
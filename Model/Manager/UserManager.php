<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    public const TABLE = '2310_user';
    public const TABLE_USER_ROLE = '2310_user_role';

    public static function makeUser(array $data): User
    {
        $user = (new User())
            ->setId($data['id'])
            ->setUsername($data['username'])
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setAge($data['age'])
            ;
        return $user->setRoles(RoleManager::getRolesByUser($user));
    }

    public static function getAll(): array
    {
        $users = [];
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE);
        if ($request) {
            foreach ($request->fetchAll() as $data) {
                $users[] = self::makeUser($data);
            }
        }
        return $users;
    }

    public static function getUser(int $id): ?User
    {
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $request ? self::makeUser($request->fetch()) : null;
    }

    public static function userExist(int $id): bool
    {
        $request = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $request ? $request->fetch()['cnt'] : 0;
    }

    public static function mailUserExist(string $email): bool
    {
        $request = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE email = '".$email."'");
        return $request ? $request->fetch()['cnt'] : 0;
    }

    public static function usernameUserExist(string $username): bool
    {
        $request = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE username = '".$username."'");
        return $request ? $request->fetch()['cnt'] : 0;
    }

    public static function getUserByMail(string $email): ?User
    {
        $stmt = DB::getPDO()->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        return $stmt->execute() ? self::makeUser($stmt->fetch()) : null;
    }

    public static function getUserByUsername(string $username): ?User
    {
        $stmt = DB::getPDO()->prepare("SELECT * FROM " . self::TABLE . " WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        return $stmt->execute() ? self::makeUser($stmt->fetch()) : null;
    }

    public static function addUser(User &$user): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO " . self::TABLE . " (username, firstname, lastname, email, password, age)
            VALUES (:username, :firstname, :lastname, :email, :password, :age)
        ");

        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':firstname', $user->getFirstname());
        $stmt->bindValue(':lastname', $user->getLastname());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':age', $user->getAge());

        $result = $stmt->execute();
        $user->setId(DB::getPDO()->lastInsertId());
        if ($result) {
            $role = RoleManager::getRolesByName(RoleManager::ROLE_USER);
            $resultRole = DB::getPDO()->exec("
                INSERT INTO " . self::TABLE_USER_ROLE . " (user_fk, role_fk)
                VALUES (".$user->getId().", ".$role->getId().")
            ");
        }
        return $result && $resultRole;
    }
}

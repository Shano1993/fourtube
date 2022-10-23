<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Role;
use App\Model\Entity\User;

class RoleManager
{
    public const TABLE = '2310_role';
    public const TABLE_ROLE = '2310_user_role';
    public const ROLE_USER = 'user';

    public static function getAll(): array
    {
        $roles =[];
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE);
        if ($request) {
            foreach ($request->fetchAll() as $roleData) {
                $roles[] = (new Role())
                    ->setId($roleData['id'])
                    ->setRoleName($roleData['role_name'])
                    ;
            }
        }
        return $roles;
    }

    public static function getRolesByUser(User $user): array
    {
        $roles = [];
        $rolesRequest = DB::getPDO()->query("
            SELECT * FROM " . self::TABLE . " WHERE id IN (SELECT role_fk FROM " . self::TABLE_ROLE . " WHERE user_FK = {$user->getId()})
        ");
        if ($rolesRequest) {
            foreach ($rolesRequest->fetchAll() as $roleData) {
                $roles[] = (new Role())
                    ->setId($roleData['id'])
                    ->setRoleName($roleData['role_name'])
                    ;
            }
        }
        return $roles;
    }

    public static function getRolesByName(string $roleName): Role
    {
        $role = new Role();
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE role_name =  '".$roleName."'");
        if ($request && $roleData = $request->fetch()) {
            $role->setId($roleData['id']);
            $role->setRoleName($roleData['role_name']);
        }
        return $role;
    }
}

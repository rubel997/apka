<?php

namespace App\Services;


class RoleService
{

    const ADMINISTRATOR = 0;
    const DIRECTOR = 1;
    const WORKER = 2;
    const CLIENT = 3;

    const READ = 1;
    const WRITE = 2;

    protected static $permissions = [
        self::ADMINISTRATOR => [
            'user' => self::WRITE,
            'street' => self::WRITE,
            'region' => self::WRITE,
            'car' => self::WRITE,
            'notification' => self::READ,
            'invoice' => self::WRITE,
        ],
        self::DIRECTOR => [
            'street' => self::WRITE,
            'region' => self::WRITE,
            'car' => self::WRITE,
            'notification' => self::READ,
            'invoice' => self::WRITE,
        ],
        self::WORKER => [
            'car' => self::READ,
            'notification' => self::READ,
            'invoice' => self::WRITE,
        ],
        self::CLIENT => [
            'notification' => self::WRITE,
            'invoice' => self::WRITE,
        ]
    ];

    protected static $permissionsNames = [
        self::ADMINISTRATOR => 'Administrator',
        self::DIRECTOR => 'Kierownik',
        self::WORKER => 'Pracownik',
        self::CLIENT => 'Klient'
    ];

    /**
     * RoleService constructor.
     */
    public function __construct() {
    }

    public static function getPermissions($role) {
        return self::$permissions[$role];
    }

    public static function checkPermission($module, $role = null) {
        if (empty($role)) {
            $role = auth()->user()->role;
        }

        return in_array($module, array_keys(self::getPermissions($role)));
    }

    public static function hasWritePermission($module, $role = null) {
        if (empty($role)) {
            $role = auth()->user()->role;
        }

        $roles = self::getPermissions($role);

        return (array_get($roles, $module, 0) == self::WRITE);
    }

    public static function hasReadPermission($module, $role = null) {
        if (empty($role)) {
            $role = auth()->user()->role;
        }

        $roles = self::getPermissions($role);

        return (array_get($roles, $module, 0) >= self::READ);
    }

    public static function checkRole($role) {
        return auth()->user()->role == $role;
    }

    public static function getPermissionName($key) {
        return array_get(self::$permissionsNames, $key, 'Niezdefiniowany');
    }
}

<?php

namespace content\enums;

/**
 *  Class seguridad
 *
 */
class seguridad
{

    public static $root = 1;

    public static $admin = 2;

    public static $supervisor = 3;

    public static $secretaria = 4;

    public static function getRolName($rol)
    {
        switch ($rol) {
            case self::$root:
            {
                return 'Root';
                break;
            }
            case self::$admin:
            {
                return 'Administrador';
                break;
            }
            case self::$supervisor:
            {
                return 'Supervisor';
                break;
            }
            default:
            {
                return 'Secretaria';
                break;
            }
        }
    }
}
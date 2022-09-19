<?php

namespace content\models;

use content\config\conection\database as BD;
use PDO as pdo;
use content\core\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 *  Class seguirdad model
 *
 * @var content\models
 */
class seguridadModel extends Model
{
    public $id;
    public $nombre;
    public $fecha_creado;
    public $fecha_actualizado;
    public $fecha_eliminado;

    public function getRoles()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id,nombre FROM roles");
        $sql->execute();
        $roles = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $roles;
    }

    public function getRolePermissionUser($roleId)
    {
        $connexionBD = BD::crearInstancia();
        $sql = $connexionBD->prepare("SELECT permisos.id as permiso, permisos.nombre as permiso_nombre FROM roles
         INNER JOIN users ON users.role_id = roles.id 
         INNER JOIN permisos_roles ON permisos_roles.role_id = roles.id 
         INNER JOIN permisos ON permisos_roles.permiso_id = permisos.id
         WHERE roles.id =?");
        $sql->execute(array($roleId));
        $userRolPermiso = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $userRolPermiso;
    }

    // Agregar permiso
    public static function agregar_permiso($nombre, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO permisos (nombre, fecha_creado, fecha_actualizado, fecha_eliminado) 
        VALUES (?,?,?,?)");
        return $sql->execute([$nombre, $fecha, $fecha, $fecha]);
    }

    // obtener permisos
    public static function obtener_permisos()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT permisos.id as permiso, permisos.nombre as permiso_nombre FROM permisos");
        $sql->execute();
        $permisos = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $permisos;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'nombre' => [self::RULE_REQUIRED],
        ];
    }
}
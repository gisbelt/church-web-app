<?php

namespace content\models;

use PDO as pdo;
use content\config\conection\database as BD;
use content\core\Model;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class rolesModel extends Model
{
    public $id;
    public $nombre;
    public $status;
    public $fecha_creado;
    public $fecha_actualizado;

    public function getRoles()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id,nombre FROM roles");
        $sql->execute();
        $roles = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $roles;
    }

    public static function getRoleUser($roleId)
    {
        $connexionBD = BD::crearInstancia();
        $sql = $connexionBD->prepare("SELECT roles.id as rol, roles.nombre as permiso_nombre FROM roles
         INNER JOIN usuarios ON usuarios.role_id = roles.id 
         WHERE roles.id =?");
        $sql->execute(array($roleId));
        $userRol = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $userRol;
    }

    // Agregar rol
    public static function agregar_rol($nombre, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO roles (nombre, fecha_creado, fecha_actualizado, status) 
        VALUES (?,?,?,?)");
        return $sql->execute([$nombre, $fecha, $fecha, self::ACTIVE]);
    }

    // Actualizar rol
    public static function actualizar_rol($id, $nombre, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE roles SET nombre = ?, fecha_actualizado = ? WHERE id = ?");
        $rol = $sql->execute(array($nombre, $fecha, $id));
        return $rol;
    }

    // obtener roles
    public static function obtener_roles()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT roles.id as rol, roles.nombre as role_nombre FROM roles WHERE
                                            roles.status = ?");
        $sql->execute(array(self::ACTIVE));
        $roles = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $roles;
    }

    // obtener rol por id
    public static function id_rol($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT roles.id as rol, roles.nombre as role_nombre FROM roles WHERE
                                            roles.id = ?");
        $sql->execute(array($id));
        $rol = $sql->fetch(PDO::FETCH_ASSOC);
        return $rol;
    }

    // Eliminar rol
    public static function eliminar($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE roles SET status = ? WHERE id = ?");
        $rol = $sql->execute(array(self::INACTIVE, $id));
        return $rol;
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
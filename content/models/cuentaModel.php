<?php

namespace content\models;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use content\core\Model;
use content\config\conection\database as BD;
use PDO;

/**
 *  Class usuario model
 * @package content\models
 */
class cuentaModel extends Model //BD
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $role_id;
    public $nombreMiembro;
    public $fecha_creado;
    public $fecha_actualizado;

    //Obtener Usuarios por Correo
    public static function obtener_usuario_correo($email)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT usuarios.username, perfiles.telefono, perfiles.direccion, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo FROM usuarios 
        INNER JOIN miembros ON miembros.id = usuarios.miembro_id
        INNER JOIN perfiles ON perfiles.miembro_id = miembros.id
        WHERE usuarios.email = ?");
        $sql->execute(array($email));
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    // Actualizar username
    public static function actualizar_username($username,$email)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE usuarios 
        INNER JOIN miembros ON miembros.id = usuarios.miembro_id
        INNER JOIN perfiles ON perfiles.miembro_id = miembros.id
        SET usuarios.username = ? 
        WHERE usuarios.email = ?");
        $usuario = $sql->execute(array($username,$email));
        return $usuario;
    }
    public static function obtener_username($email)
    {
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT username FROM usuarios where email=?");
        $sql->execute(array($email));
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $result = $row["username"];
        return $result;
    }
    


    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 16]],
        ];
    }
}

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
    public $clave;
    public $role_id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $direccion;
    public $fecha_creado;
    public $fecha_actualizado;

    //Obtener Usuarios por Correo
    public static function obtener_usuario_correo($email)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT usuarios.username, perfiles.telefono, perfiles.direccion, perfiles.nombre, perfiles.apellido FROM usuarios 
        INNER JOIN miembros ON miembros.id = usuarios.miembro_id
        INNER JOIN perfiles ON perfiles.miembro_id = miembros.id
        WHERE usuarios.email = ?");
        $sql->execute(array($email));
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    // Actualizar username
    public static function actualizar_username($username,$fecha_actualizado,$email)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE usuarios 
        INNER JOIN miembros ON miembros.id = usuarios.miembro_id
        INNER JOIN perfiles ON perfiles.miembro_id = miembros.id
        SET usuarios.username = ?, usuarios.fecha_actualizado = ? 
        WHERE usuarios.email = ?");
        $usuario = $sql->execute(array($username,$fecha_actualizado,$email));
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

    // Actualizar username
    public static function actualizar_nombre($nombre,$apellido,$fecha_actualizado,$email)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE perfiles 
        INNER JOIN miembros ON miembros.id = perfiles.miembro_id
        INNER JOIN usuarios ON usuarios.miembro_id = miembros.id
        SET perfiles.nombre = ?, perfiles.apellido = ?, perfiles.fecha_actualizado = ?
        WHERE usuarios.email = ?");
        $usuario = $sql->execute(array($nombre,$apellido,$fecha_actualizado,$email));
        return $usuario;
    }
    public static function obtener_nombre($email)
    {
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT nombre, apellido FROM perfiles 
        INNER JOIN miembros ON miembros.id = perfiles.miembro_id
        INNER JOIN usuarios ON usuarios.miembro_id = miembros.id
        WHERE usuarios.email=?");
        $sql->execute(array($email));
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $result = array('nombre' => $row["nombre"], 'apellido' => $row["apellido"]);
        return json_encode($result);
    }

     // Actualizar telefono
     public static function actualizar_telefono($telefono,$fecha_actualizado,$email)
     {
         $conexionBD = BD::crearInstancia();
         $sql = $conexionBD->prepare("UPDATE perfiles 
         INNER JOIN miembros ON miembros.id = perfiles.miembro_id
         INNER JOIN usuarios ON usuarios.miembro_id = miembros.id
         SET perfiles.telefono = ?, perfiles.fecha_actualizado = ?
         WHERE usuarios.email = ?");
         $usuario = $sql->execute(array($telefono,$fecha_actualizado,$email));
         return $usuario;
     }
     public static function obtener_telefono($email)
     {
         $conexionBD=BD::crearInstancia();
         $sql= $conexionBD->prepare("SELECT telefono FROM perfiles 
         INNER JOIN miembros ON miembros.id = perfiles.miembro_id
         INNER JOIN usuarios ON usuarios.miembro_id = miembros.id
         WHERE usuarios.email=?");
         $sql->execute(array($email));
         $row = $sql->fetch(PDO::FETCH_ASSOC);
         $result = $row["telefono"];
         return $result;
     }

      // Actualizar direccion
      public static function actualizar_direccion($direccion,$fecha_actualizado,$email)
      {
          $conexionBD = BD::crearInstancia();
          $sql = $conexionBD->prepare("UPDATE perfiles 
          INNER JOIN miembros ON miembros.id = perfiles.miembro_id
          INNER JOIN usuarios ON usuarios.miembro_id = miembros.id
          SET perfiles.direccion = ?, perfiles.fecha_actualizado = ?
          WHERE usuarios.email = ?");
          $usuario = $sql->execute(array($direccion,$fecha_actualizado,$email));
          return $usuario;
      }
      public static function obtener_direccion($email)
      {
          $conexionBD=BD::crearInstancia();
          $sql= $conexionBD->prepare("SELECT direccion FROM perfiles 
          INNER JOIN miembros ON miembros.id = perfiles.miembro_id
          INNER JOIN usuarios ON usuarios.miembro_id = miembros.id
          WHERE usuarios.email=?");
          $sql->execute(array($email));
          $row = $sql->fetch(PDO::FETCH_ASSOC);
          $result = $row["direccion"];
          return $result;
      }

        // Actualizar clave
        public static function actualizarClave($email, $clave)
        {
            $conexionBD = BD::crearInstancia();
            $sql = $conexionBD->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
            $usuario = $sql->execute(array($clave, $email));
            return $usuario;
        }
        public static function obtener_clave_actual($email)
        {
            $conexionBD=BD::crearInstancia();
            $sql= $conexionBD->prepare("SELECT password FROM usuarios WHERE email=?");
            $sql->execute(array($email));
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $result = $row["password"];
            return $result;
        }
    


    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            // 'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 16]],
        ];
    }
}

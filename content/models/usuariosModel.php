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
class usuariosModel extends Model //BD
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $role_id;
    public $nombreMiembro;
    public $fecha_creado;
    public $fecha_actualizado;

    //Login
    public static function login($email)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id,username,email,password, role_id, status
        FROM usuarios WHERE email=?");
        $sql->execute(array($email));
        $consultarUsuario = $sql->fetch(PDO::FETCH_ASSOC);
        return $consultarUsuario;
    }

    //Validación del login
    public static function validarLogin()
    {
        header("Cache-control: private");
        header("Cache-control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        // Si la sesion esta vacía o no hay usuario logueado, redirecciona al login
        if (!isset($_SESSION['email'])) {
            header("Location: /");
        } else {
            // sino, si ese usuario tiene un valor, imprime esa información
            if ($_SESSION['email'] == 'ok') {
                $username = $_SESSION['username'];
                $date = $_SESSION['date'];
            }
        }
        return [$username, $date];
    }

    //Crear usuario
    public static function crear($username, $email, $password, $rol, $miembro, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("INSERT INTO usuarios (username, email, password, miembro_id, status, role_id, fecha_creado) 
        VALUES (?,?,?,?,?,?,?)");
        $user = $sql->execute(array($username, $email, $password, $miembro, self::ACTIVE, $rol, $fecha));
        return $user;
    }

    // Validar que esté la sesión cerrada 
    public static function validarLogout()
    {
        // Si existe alguien logueado, mosrar alerta de cerrar sesión
        if (isset($_SESSION['email'])) {

            $logger = new Logger("web");
            $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
            $logger->debug(__METHOD__, [$_SESSION['email']]);
        }
        if (isset($_SESSION['email'])) {
            echo "
            <script>
            alert('Por favor cerrar sesión');
            window.location.href = '/home';
            </script>";
        }
    }

    //Buscar Miembros
    public static function buscarMiembro($nombreMiembro)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT p.nombre as nombreMiembro, p.apellido as apellidoMiembro, p.cedula as cedulaMiembro, m.id as idMiembro
        FROM miembros as m
        INNER JOIN perfiles as p ON p.miembro_id=m.id
        WHERE p.nombre LIKE ? or p.apellido LIKE ? or p.cedula LIKE ?");
        $sql->execute(array("%" . $nombreMiembro . "%", "%" . $nombreMiembro . "%", "%" . $nombreMiembro . "%"));
        $buscarMiembro = $sql->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($buscarMiembro as $key) {
            $result[] = array(
                'id' => $key['idMiembro'],
                'nombre' => $key['nombreMiembro'],
                'apellido' => $key['apellidoMiembro'],
                'cedula' => $key['cedulaMiembro'],
            );
        }

        echo json_encode($result);
    }

    public static function obtener_usuarios($cargo, $status, $miembro)
    {
        $connexionBD = BD::crearInstancia();
        $query = "SELECT usuarios.id, usuarios.email, usuarios.status, usuarios.fecha_creado, cargos.nombre, cargos.id, CONCAT(perfiles.nombre,' ',perfiles.apellido) AS nombre_completo, miembros.id   FROM usuarios
            INNER JOIN miembros ON usuarios.miembro_id = miembros.id
            INNER JOIN perfiles ON miembros.id = perfiles.miembro_id
            INNER JOIN cargos ON miembros.cargo_id = cargos.id";
        $conditions = array();

        if($cargo != '') {
            $conditions[] = "cargos.id='$cargo'";
        }
        if($status != '') {
            $conditions[] = "usuarios.status='$status'";
        }
        if($miembro != '') {
            $conditions[] = "miembros.id='$miembro'";
        }
        $queryString = $query;
        if (count($conditions) > 0) {
            $queryString .= " WHERE " . implode(' AND ', $conditions);
        }
        $sql = $connexionBD->prepare($queryString);
        $sql->execute();
        $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $usuarios;
    }

    public static function id_usuario($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT * FROM usuarios WHERE id = ?");
        $sql->execute(array($id));
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    // Actualizar usuario
    public static function actualizar($id, $username, $email, $status, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE usuarios SET username = ?, email = ?, status = ?, fecha_actualizado = ? WHERE id = ?");
        $usuario = $sql->execute(array($username, $email, $status, $fecha, $id));
        return $usuario;
    }

    // Actualizar clave
    public static function actualizarClave($id, $clave)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
        $usuario = $sql->execute(array($clave, $id));
        return $usuario;
    }

    public static  function eliminar($id) {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("UPDATE usuarios SET status = ? WHERE id = ?");
        $usuarios = $sql->execute(array(self::INACTIVE, $id));
        return $usuarios;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 16]],
        ];
    }
}
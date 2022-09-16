<?php

namespace content\models;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use content\core\Model;
use content\config\conection\database as BD;
use PDO as pdo;

class usuariosModel extends Model //BD
{
    public $id;
    public $username;
    public $email;
    public $password = "password";

    //Login
    public static function login($email)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id,username,email,password 
        FROM users WHERE email=?");
        $sql->execute(array($email));
        $consultarUsuario = $sql->fetch(PDO::FETCH_LAZY);
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
            header("Location: /index");
        } else {
            // sino, si ese usuario tiene un valor, imprime esa información
            if ($_SESSION['email'] == 'ok') {
                $username = $_SESSION['username'];
                $date = $_SESSION['date'];
            }
        }
        return [$username, $date];
    }

    // Validar que esté la sesión cerrada 
    public static function validarLogout()
    {
        // Si existe alguien logueado, mosrar alerta de cerrar sesión
        if(isset($_SESSION['email'])){

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

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 16]]
            //password => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password]],
        ];
    }

}
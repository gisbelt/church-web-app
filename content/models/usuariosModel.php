<?php

namespace content\models;

use content\config\conection\database as BD;
use PDO as pdo;

class usuariosModel extends BD
{

    public $id;
    public $username;
    public $email;
    public $password = "password";

    //Login
    public static function login($email)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT username,email,password 
        FROM users WHERE email=?");
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

    // Validar que esté la sesión cerrada 
    public static function validarLogout()
    {
        // Si existe alguien logueado, mosrar alerta de cerrar sesión
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
        $sql = $conexionBD->prepare("SELECT p.nombre as nombreMiembro, m.id as idMiembro
        FROM miembros as m
        INNER JOIN perfiles as p ON p.miembro_id=m.id
        WHERE p.nombre LIKE '%".$nombreMiembro."%'");  
        $sql->execute(array($nombreMiembro));
        $buscarMiembro = $sql->fetch(PDO::FETCH_ASSOC); 
        $return = array (id => $buscarMiembro['idMiembro'], nombre => $buscarMiembro['nombreMiembro']);
        die(json_encode($return));
    }

}

?>